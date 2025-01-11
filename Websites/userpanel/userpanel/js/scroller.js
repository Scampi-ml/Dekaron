var scrollerheight1= 142; // 
var html1= "";
var total_area1= 0;
var wait_flag1= true;
var bMouseOver1= 1;
var scrollspeed1= 1; // 
var waitingtime1= 1500; // 
var s_tmp1= 0;
var s_amount1= 142;
var scroll_content1= new Array();
var startPanel1= 0;
var n_panel1= 0;
var i= 0;
function startscroll1() {
	i= 0;
	for (i in scroll_content1) n_panel1++;
	n_panel1= n_panel1 - 1 ;
	startPanel1= 0
	if (startPanel1==0) {
		i= 0;
		for (i in scroll_content1) insert_area1(total_area1, total_area1++); // area 
	} else if (startPanel1==n_panel1) {
		insert_area1(startPanel1, total_area1);
		total_area1++;
		for (i=0 ; i<startPanel1 ; i++) {
			insert_area1(i, total_area1); // area 
			total_area1++;
		}
	} else if ((startPanel1>0) || (startPanel1<n_panel1)) {
		insert_area1(startPanel1, total_area1);
		total_area1++;
		for (i=startPanel1+1 ; i<=n_panel1 ; i++) {
			insert_area1(i, total_area1); // area 
			total_area1++;
		}
		for (i=0 ; i<startPanel1 ; i++) {
			insert_area1(i, total_area1); // area 
			total_area1++;
		}
	}
	window.setTimeout("scrolling1()",waitingtime1);
}
function scrolling1() { // 
	if (bMouseOver1 && wait_flag1) {
		for (i=0 ; i<total_area1 ; i++) {
			tmp= document.getElementById('scroll_area1'+i).style;
			tmp.top = parseInt(tmp.top) - scrollspeed1;
			if (parseInt(tmp.top)<=(-scrollerheight1)) {
				tmp.top= scrollerheight1 * (total_area1-1);
			}
			if (s_tmp1++ > ((s_amount1-1)*scroll_content1.length)) {
				wait_flag1= false;
				window.setTimeout("wait_flag1=true;s_tmp1=0;",waitingtime1);
			}
		}
	}
	window.setTimeout("scrolling1()",1);
}
function insert_area1(idx, n) { // area 
	html1= '<div style="left: 0px; width: 630px; position: absolute; top: ' + (scrollerheight1*n) + 'px" id="scroll_area1' + n + '">\n';
	html1+= scroll_content1[idx] + '\n';
	html1+= '</div>\n';
	document.write(html1);
}

