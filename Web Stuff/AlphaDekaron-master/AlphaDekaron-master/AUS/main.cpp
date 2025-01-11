#include <fstream>
#include <ctime>
#include <vector>
#include <winsock2.h>
#include <iostream>

using namespace std;

int port;
string host,cVer,pVer,note;
ofstream fLog;
DWORD WINAPI SocketHandler(void*);
/*
Function to determine if a file exists

Arguments:
    fName       Absolute path of the file to be checked

Return value:
    True/False      True if it exists. False if it doesn't.
*/
bool fExists(string fName)
{
    FILE *fp = fopen(fName.c_str(),"r");
    if(fp)
    {
        fclose(fp);
        return true;
    }
    else return false;
}

/*
Function to stamp time

Return value:
    string of the current system's time
*/
string stamp()
{
    time_t rawtime;
    struct tm * timeinfo;
    time (&rawtime);
    timeinfo = localtime ( &rawtime );
    string time = asctime (timeinfo);
    return time.substr(0, time.size()-1);
}

/*
Function to split a string

Arguments:
    str             String to be split
    storage         Stores split up values
    delimiters      Delimiters that the string is split by
*/
void stringSplit(const string& str, vector<string>& storage, const string& delimiters)
{
    string::size_type lastPos = str.find_first_not_of(delimiters, 0);
    string::size_type pos = str.find_first_of(delimiters, lastPos);
    while (string::npos!=pos || string::npos!=lastPos)
    {
        storage.push_back(str.substr(lastPos, pos - lastPos));
        lastPos=str.find_first_not_of(delimiters, pos);
        if(lastPos-pos > 1)
        {
            for(unsigned int q=0; q<((lastPos-pos)-1); q++)
            {
                storage.push_back("NULL");
            }
        }
        pos = str.find_first_of(delimiters, lastPos);
    }
}

/*
Function to load the settings.ini file
*/
void loadSettings()
{
    string line;
    ifstream iF("settings.ini");
    if(iF.is_open())
    {
        vector<string> store;
        while(iF.good())
        {
            getline(iF,line);
            if(line[0]!='#' && line[0]!='\0')
            {
                stringSplit(line,store,"=");
                if(store[0]=="host")host=store[1];
                if(store[0]=="cver")cVer=store[1];
                if(store[0]=="pver")pVer=store[1];
                if(store[0]=="notice")note=store[1];
                if(store[0]=="port")port=atoi(store[1].c_str());
            }
            store.clear();
        }
        iF.close();
    }
}

/*
Function to handle the communication over the socket
*/
DWORD WINAPI SocketHandler(void* lp)
{
    int *csock = (int*)lp;
    char buffer[1024];
    string stuff = host+","+cVer+","+pVer+","+note;
    char info[stuff.size()];
    stuff.copy(info,stuff.size(),0);
    memset(buffer, 0, sizeof(buffer));
    if((recv(*csock, buffer, sizeof(buffer), 0))==SOCKET_ERROR)
    {
        cout<<stamp()<<"\tError receiving data\t"<< WSAGetLastError()<<"\n";
        goto FINISH;
    }
    if(strncmp(buffer, "Req", 3)==0)
    {
        memset(buffer, 0, sizeof(buffer));
        strncpy(buffer, info, sizeof(info));
    }
    if((send(*csock, buffer, strlen(buffer), 0))==SOCKET_ERROR)
    {
        cout<<stamp()<<"\tError sending data\t"<<WSAGetLastError()<<"\n";
        goto FINISH;
    }
FINISH:
    free(csock);
    return 0;
}

/*
Function to start the server

Arguments:
    host_port   the port that will be used
*/
void startServer(int host_port)
{
    int addr_size = sizeof(SOCKADDR);
    unsigned short wVersionRequested;
    WSADATA wsaData;
    int err;
    wVersionRequested = MAKEWORD( 2, 2 );
    err = WSAStartup( wVersionRequested, &wsaData );
    if ( err != 0 || ( LOBYTE( wsaData.wVersion ) != 2 || HIBYTE( wsaData.wVersion ) != 2 ))
    {
        cout<<stamp()<<"\tCould not find useable sock dll\t"<<WSAGetLastError()<<"\n";
        goto FINISH;
    }
    int hsock;
    int * p_int ;
    hsock = socket(AF_INET, SOCK_STREAM, 0);
    if(hsock == -1)
    {
        cout<<stamp()<<"\tError initializing socket\t"<<WSAGetLastError()<<"\n";
        goto FINISH;
    }
    p_int = (int*)malloc(sizeof(int));
    *p_int = 1;
    if( (setsockopt(hsock, SOL_SOCKET, SO_REUSEADDR, (char*)p_int, sizeof(int)) == -1 )|| (setsockopt(hsock, SOL_SOCKET, SO_KEEPALIVE, (char*)p_int, sizeof(int)) == -1 ) )
    {
        cout<<stamp()<<"\tError setting options\t"<<WSAGetLastError()<<"\n"<<"\n";
        free(p_int);
        goto FINISH;
    }
    free(p_int);
    struct sockaddr_in my_addr;
    my_addr.sin_family = AF_INET ;
    my_addr.sin_port = htons(host_port);
    memset(&(my_addr.sin_zero), 0, 8);
    my_addr.sin_addr.s_addr = INADDR_ANY ;
    if( bind( hsock, (struct sockaddr*)&my_addr, sizeof(my_addr)) == -1 )
    {
        cout<<stamp()<<"\tError binding to socket, make sure nothing else is listening on this port\t"<<WSAGetLastError()<<"\n";
        goto FINISH;
    }
    if(listen( hsock, 10) == -1 )
    {
        cout<<stamp()<<"\tError listening\t"<<WSAGetLastError()<<"\n";
        goto FINISH;
    }
    int* csock;
    sockaddr_in sadr;
    cout<<stamp()<<"\tServer started\n";
    while(true)
    {
        csock = (int*)malloc(sizeof(int));

        if((*csock = accept( hsock, (SOCKADDR*)&sadr, &addr_size))!= INVALID_SOCKET )
        {
            cout<<stamp()<<"\t"<<inet_ntoa(sadr.sin_addr)<<" connected"<<"\n";
            CreateThread(0,0,&SocketHandler, (void*)csock , 0,0);
        }
        else
        {
            cout<<stamp()<<"\tError accepting\t"<<WSAGetLastError()<<"\n";
        }
    }

FINISH:
    free(csock);
}

int main(int argc, char *argv[])
{
    if(!fExists("settings.ini"))
    {
        cout<<stamp()<<"\tsettings.ini not found\n";
        goto QUIT;
    }
    loadSettings();
    startServer(port);
QUIT:
    return 0;
}
