








































function reformat_table(t) {
	if(t.className.match(/not-foldable/)) return;
	var nt = t.cloneNode(false);
	var ntbody = _mkel("tbody");
	nt.appendChild(ntbody);

	var head = t.getElementsByTagName("thead").item(0);
	var headers = [];
	if(head) {
		var tr = head.getElementsByTagName("tr").item(0);
		var cells = tr.childNodes;
		for(var i=0; i<cells.length; i++) {
			if(!cells.item(i).tagName) continue;
			headers.push(cells.item(i));
		}
	}
	var body = t.getElementsByTagName("tbody").item(0);
	if(!body) return;
	var rows = body.getElementsByTagName("tr");
	var skip_before = {};
	for(var i=0; i<rows.length; i++) {
		var cells = rows.item(i).childNodes;
		var k=0;
		for(var j=0; j<cells.length; j++) {
			if(!cells.item(j).tagName) continue;
			var original_k = k;
			while(skip_before[k]) { 
        k++; skip_before[k]--;
      }
			if(k < headers.length && (original_k == k || headers.length > k+1)) {
				

				var cell = headers[k].cloneNode(true);
				cell.style.width="auto";
				ntbody.appendChild(_mkel("tr", {}, [cell]));			
			}
			var cell = cells.item(j).cloneNode(true);
			cell.style.width="auto";
			if(cell.rowSpan > 1) skip_before[k] = cell.rowSpan - 1;
			cell.rowSpan=1;
			ntbody.appendChild(_mkel("tr", {}, [cell]));			
			k+=cell.colSpan;
		}
	}
	nt.style.width="100%";
	nt.className = nt.className + " reformatted";
	t.parentNode.replaceChild(nt, t);
}






if(small_screen) {
	var effective_body = document.getElementById("effective-body");
	var tables = effective_body.getElementsByTagName("table");

	for(var i=0; i<tables.length; i++) 
		if(tables.item(i).clientWidth > effective_body.clientWidth)
			reformat_table(tables.item(i));
}
