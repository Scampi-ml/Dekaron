<?php

require_once "config.inc.php"; //pede o config.inc.php

// verifica se a sessao tem o valor de 1 e a recolha do step2 também é 1 
if(isset($_SESSION[step2]) && isset($_POST[step2])) { 
   	 	$errorStr = formStep3(); //se der erro vai ao formStep3
    		if($errorStr!=null){ //se errorStr for diferente de null entao
        		require_once('cash.html'); //chama cash.html
    }else{ //se nao
        $success="sucess adding to account:$_POST[user_id]coins$_POST[cash]coins"; //sucesso = valores adicionados
		require_once('success.html'); //chama success.html
		unset($_SESSION[step2], $_SESSION[step1]); //limpa os valores da sessao
    }}
	else{
   	 	require_once('cash.html'); //chama o cash.html
    	$_SESSION[step2] = 0; } //da o valor 0 a sessao
	
//Começa aqui a verificacao dos dados introduzidos
$user_ = $_POST['user_id']; //Copia o conteudo do formulario para variaveis	
$cash_ = $_POST['cash']; 

if (!$user_ || !$cash_ ) { //Verifica se as variaveis estao preenchidas
echo 'Please fill the complete form. Go back and try again.' ; 
exit; 
} 

if (is_numeric($cash_)){ //Verifica se o conteudo da variavel cash_ e numerico
}
else {
echo 'Please fill the cash form with numbers only.' ; 
exit;
}

function formStep3(){
    $errors = array();
    $errorStr = null;
			
//conexao DB
if(odbc_connect('account','DBUSER',''DBPASS'') === false ) { //verifica se e possivel estabelecer ligacao a BD
    echo 'Error: cannot connect to database.' ;
	exit;
}
	$strSql1="SELECT * FROM account.dbo.USER_PROFILE WHERE user_id='$user_' and user_pwd='$pwd_'"; //verifica os dados da DB com os dados inserido
	$account_odbc = odbc_connect('account','DBUSER',''DBPASS''); //dados de acesso base de dados
    $user_result=odbc_do($account_odbc,$strSql1); //ligacao
    odbc_fetch_row($user_result); //obtencao dados
	$user_no=odbc_result($user_result,1); //apresenta 1 resultado
	odbc_close($account_odbc); //fecha a BD

echo '<br>Utilizador: ' .$user_ ; 
echo '<br>Guito ' .$cash_ ;
echo '<br>User result ' .$user_result ;
echo '<br>user_no ' .$user_no ;

    if ( $user_no== null) $errors[]="Your account name is incorrect. Please go back and try again."; //se o utilizador = null e porque nao ha registos desse utilizador
	//if(!preg_match("/^[0-9]{1,12}$/i",$_POST[cash])) $errors[]="Error";
	
	$strSql2="select * from cash.dbo.user_cash where user_no='$user_no'"; //Consulta os registos do utilizador
    $cash_odbc = odbc_connect('account','DBUSER',''DBPASS''); //dados de acesso base de dados
    $user_cash_result=odbc_do($cash_odbc,$strSql2); //ligacao
    odbc_fetch_row($user_cash_result); //obtencao dados
	$cash_id=odbc_result($user_cash_result,1); //apresenta 1 resultado da identificacao
	$user_cash=odbc_result($user_cash_result,4); //apresenta 4 resultados do dinheiro do utilizador
	odbc_close($cash_odbc); //fecha a base de dados
	
    if ($cash_id== null)  $errors[] = "$user_no Player never opened the d-shop"; //se nao houver registo na tabela cash
    if (strlen($_POST[cash])<1) $errors[]="Please open the shop once!"; //se o dinheiro for menos de 1 e porque nunca foi a loja
    
	if(sizeof($errors)>0){ //se houver mais de um erro cria a estrutura
       $errorStr .= "<br><font>";
       $errorStr .= "Following errors ocurred:";
       foreach($errors as $error)
               $errorStr .= "<li>$error</li>";
       $errorStr .= "</font><br><br>";
    }
	else{

	//actualiza o dinheiro do utilizador se não houver erros
    $cash_query="update cash.dbo.user_cash set amount=amount+$_POST[cash] where user_no='$user_no'";
    $dk_cash_odbc = odbc_connect('account','DBUSER',''DBPASS''); //dados de acesso base de dados
    $dk_cash_result=odbc_do($dk_cash_odbc,$cash_query); //ligacao e transmissao dados
	odbc_close($dk_cash_odbc); //fecha a base de dados.
    	}
    
	return $errorStr;
	
}

?>