



Number.prototype.padTo=function(n) {
	if(this.length > n) return;
	var r="" + this
	while(r.length < n) {
		r = "0" + r
	}
	return r;
}




function pad_2(num_string) {
	num_string = "" + num_string;
  if(num_string.length >= 2) {
    return num_string;
  } else {
    return "0"+num_string;
  }
}




function days_in_month(year, month) {
  month--; // To get 0-11 months
  month++; // Because we want to look at the next month!
  
  if(month>11) {
    month=0;
    year++;
  }
  start_of_next_month = new Date(year, month);
  end_of_this_month = new Date(start_of_next_month.getTime() - (1000*60*60*12));
  return end_of_this_month.getDate();
}





function set_max_day_from_value(name) {
  max_day=days_in_month(
    document.getElementById(name+".y").value, 
    document.getElementById(name+".m").value
  );
  for(i = 28; i<max_day+1; i++) {
    document.getElementById(name+".d."+i).disabled=false;
  }
  for(i = max_day+1; i<32; i++) {
    document.getElementById(name+".d."+i).disabled=true;
  }
  if(document.getElementById(name+".d").value > max_day)
    document.getElementById(name+".d").value = max_day;
}




function update_hidden_date(name) {
  document.getElementById(name+".h").value =
    document.getElementById(name+".y").value + "-" +
    pad_2(document.getElementById(name+".m").value) + "-" + 
    pad_2(document.getElementById(name+".d").value) +
    document.getElementById(name+".t").value;
}




function update_hidden_date_ym(name) {
  document.getElementById(name+".h").value =
    document.getElementById(name+".y").value + "-" +
    pad_2(document.getElementById(name+".m").value);
}






function find_element_root_offset(element) {
	x=0; y=0;
  while(element) {
    x+=element.offsetLeft;
    y+=element.offsetTop;
    element=element.offsetParent;
  }
	return [x,y];
}













function overlay_near_element(target_element, move_element_id, approx_width, approx_height, move_element) {
	var target_position = find_element_root_offset(target_element);
	var x = target_position[0];
	var y = target_position[1];
  move_element = move_element || document.getElementById(move_element_id);
  var divstyle=move_element.style;
  if(x>approx_width/2) {x-=approx_width/2} else {x=0}
  if(y>approx_height/2) {y-=approx_height/2} else {y=0}
  divstyle.left=x+"px";
  divstyle.top=y+"px";
  divstyle.visibility='visible';
}





function try_refresh(time, url) {
  location.href=url;
  setTimeout("try_refresh(" + time + ", '" + url + "')",time*1000);
}




function set_action(this_form, new_action) {
  var elements = this_form.elements;
  for(i = 0 ; i < elements.length ; ++i) {
    if(elements[i].name == "action")
      elements[i].value = new_action;
  }
  return true;
}
var page_title;






function override_page_title(t) {
	page_title = t;
}

var other_title_callbacks = [];








function set_title() {
	if(!page_title) {
		var heads = document.getElementsByTagName("h1");
		if(heads.length > 0) {
			var title_text_node;
			for(var i=0; i<heads.item(0).childNodes.length; i++) {
				if(heads.item(0).childNodes.item(i).data) {
					title_text_node = heads.item(0).childNodes.item(i);
					break;
				}
			}
		} else if(document.getElementById("effective-title")) {
			title_text_node=document.getElementById("effective-title").firstChild;
		} else {
			return;
		}
		if(!title_text_node) return;
		page_title = title_text_node.data;
	}
	var new_title = "Heart: ";
	// The first head should be the one we want
	new_title = new_title + page_title;
  for(var i=0; i<other_title_callbacks.length; i++)
    other_title_callbacks[i](page_title);
	document.title = new_title;
  return true; 
}





function toggle_div(id) {
  div=document.getElementById(id);
  if (div.style.display == 'none') {
    div.style.display = 'block';
  } else {
    div.style.display = 'none';
  }
}





function go_back_ish() {
  if(document.referrer && document.referrer != location.href) {
               history.go(-1); // We just go straight back.
  } else if(document.getElementById(':1.container')) {
    history.go(-2); // Go back twice if translator is loaded.
  } else {
    location.href = "/";
  }
  return false;
}





broken_windows_browser=0;
if(navigator.userAgent.toLowerCase().indexOf("msie")>=0) broken_windows_browser=1;
var xmlhttp_by_name = {};









function object_to_arg_string(args) {
	var post_content = "";
	for(var i in args) {
		if(args[i] === undefined) continue;
		if(args[i] instanceof Array) {
			for(var j=0; j<args[i].length; j++)
				post_content += i + "=" + encodeURIComponent(args[i][j]) + ";";
		} else {
			post_content += i + "=" + encodeURIComponent(args[i]) + ";";
		}
	}
  return post_content;
}







function xmlhttp_call_with_args(name, orst, url, args, sync) {
	var post_content = object_to_arg_string(args);

	var xmlhttp_o;
	if(broken_windows_browser) {
		xmlhttp_o = new ActiveXObject("MsXml2.XmlHttp");
	} else {
		xmlhttp_o = new XMLHttpRequest();
	}
	xmlhttp_by_name[name] = xmlhttp_o;
	xmlhttp_o.onreadystatechange=orst;
	xmlhttp_o.open("POST", url, !sync);
	xmlhttp_o.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	if(!navigator.userAgent.match(/AppleWebKit/)) {
		// WebKit hates this, but some other browsers may need it.
		xmlhttp_o.setRequestHeader("Content-length", post_content.length);
		xmlhttp_o.setRequestHeader("Connection", "close");
	}
	xmlhttp_o.send(post_content);
	if(sync) {
		// onreadystatechange won't have fired.
		orst();
	}
	return xmlhttp_o;
}








function build_simple_xmlr_statechange(n, on_success, on_failure, check_for_success, options) {
	options = options||{};

  var orst_fired = false;
	return function() {
    if(orst_fired) return;
		
		// if LOADED
		var my_xmlhttp = xmlhttp_by_name[n];
		if(my_xmlhttp.readyState == 4 && my_xmlhttp.status == 200) {
      orst_fired = true;
			var xmldoc=my_xmlhttp.responseXML;
			if(!xmldoc) {
				if(on_failure) on_failure();
			} else if(!xmldoc.lastChild) {
				if(on_failure) on_failure(xmldoc.lastChild);
			} else if(check_for_success && !check_for_success(xmldoc.lastChild)) {
				if(on_failure) on_failure(xmldoc.lastChild);
			} else {
				if(on_success) on_success(xmldoc.lastChild);
			}
		} else if(my_xmlhttp.readyState == 4) {
      orst_fired = true;
			if(my_xmlhttp.status && !options.skipError) {
				if(!options.silentError) alert_l("HTTP error: "+my_xmlhttp.status);
				if(on_failure) on_failure();
			}
		}
	};
}
























function xmlhttp_simple_full(url, args, check_for_success, on_success, on_failure, options) {
	options = options||{};

	// Convert the args to a POST string
	var post_content = "";
	for(var i in args) {
		if(args[i] === undefined) continue;
		if(args[i] instanceof Array) {
			for(var j=0; j<args[i].length; j++)
				post_content += i + "=" + encodeURIComponent(args[i][j]) + ";";
		} else {
			post_content += i + "=" + encodeURIComponent(args[i]) + ";";
		}
	}

	// Allocate the object
	var xmlhttp_o;
	if(broken_windows_browser) {
		xmlhttp_o = new ActiveXObject("MsXml2.XmlHttp");
	} else {
		xmlhttp_o = new XMLHttpRequest();
	}
	var on_load_fired = false;
	function on_load() {
		on_load_fired = true;
		if(xmlhttp_o.status == 200) {
      if(options.returnText) {
        if(on_success) on_success(xmlhttp_o.responseText);
      } else {
        var xmldoc=xmlhttp_o.responseXML;
        if(!xmldoc) {
          if(on_failure) on_failure();
        } else if(!xmldoc.lastChild) {
          if(on_failure) on_failure(xmldoc.lastChild);
        } else if(check_for_success && !check_for_success(xmldoc.lastChild)) {
          if(on_failure) on_failure(xmldoc.lastChild);
        } else {
          if(on_success) on_success(xmldoc.lastChild);
        }
      }
		} else {
			if(xmlhttp_o.status && !options.skipError) {
				if(!options.silentError) alert_l("HTTP error: "+xmlhttp_o.status);
				if(on_failure) on_failure();
			}
		}
	}
  var partial_load_failed = false;
	xmlhttp_o.onreadystatechange = function() {
		// if LOADED
		if(xmlhttp_o.readyState == 4) {
      // MSIE has to catch up here.
      if(partial_load_failed) options.onPartialLoad(xmlhttp_o.responseText);
      on_load();
    }
    // if partly loaded
		if(options.onPartialLoad && xmlhttp_o.readyState == 3) {
      try {
        options.onPartialLoad(xmlhttp_o.responseText);
      } catch(e) {
        // Do nothing - MSIE will just have to wait.
        partial_load_failed = true;
      }
    }
	};
  if(options.get) {
    xmlhttp_o.open("GET", url+"?"+post_content, options.sync ? false : true);
    xmlhttp_o.send();
  } else {
    xmlhttp_o.open("POST", url, options.sync ? false : true);
    xmlhttp_o.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(!navigator.userAgent.match(/AppleWebKit/)) {
      // WebKit hates this, but some other browsers may need it.
      xmlhttp_o.setRequestHeader("Content-length", post_content.length);
      xmlhttp_o.setRequestHeader("Connection", "close");
    }
    xmlhttp_o.send(post_content);
  }
	if(options.sync && ! on_load_fired) on_load();
	return xmlhttp_o;
}







var alert_count = 0;
var alert_limit = 20;
function alert_l(str, chosen_limit) {
	alert_count++;
	if(!chosen_limit) chosen_limit=alert_limit;
	if(alert_count>= chosen_limit) return;
	return window.alert(str);
}















function form_to_http_request(f, on_success, on_failure, check_for_success, override_action, include_last_submit) {
	var form_contents = {};

  function add_contents(e, default_name) {
    var name = e.name || default_name;
               if(!name) return false; // Should never happen, but does.
               form_contents[name]=form_contents[name] || [];
               form_contents[name].push(e.value);
    return true;
  }

  var last_submit;

	for(var i=0; i<f.elements.length; i++) {
		var e = f.elements.item(i);
		if(e.disabled) continue;
		if(e.type == "radio" || e.type == "checkbox") {
			if(!e.checked) continue;
    } else if(e.type == "submit") {
      last_submit=e;
      continue;
		} else if(e.type == "submit" || e.type == "image") {
			// Broken for now.
			continue;
		}
    add_contents(e);
	}
  if(include_last_submit && last_submit) add_contents(last_submit, "submit");
	form_contents['using-ajax-really']=["1"];
  var action_to_use = override_action || f.action;
  if(!action_to_use) return true; // Cannot work
  xmlhttp_simple_full(action_to_use, form_contents, check_for_success, on_success, on_failure)
	return false;
}





function replace_el_with_id(id, w) {
	var s = document.getElementById(id);
	s.parentNode.replaceChild(w, s);
	if(!w.id) w.id=id;
}






















function _mkel(name, attributes, contents, tail_tweaks) {
	var e = document.createElement(name);
	if(attributes && attributes.constructor != Object) {
		tail_tweaks = contents;
		contents = attributes;
		attributes = {};
	}
	if(attributes) {
		for(var n in attributes) {
      if(!n) continue;
			if(broken_windows_browser && n == "type" && name == "button") continue; // Skip it, cross fingers.
      if(
        attributes[n] === undefined || (
        attributes[n].constructor != String && attributes[n].constructor != Boolean)
      ) {
        






        if(!attributes[n]) continue;
      }
			if(attributes[n] && attributes[n].constructor == Object) {
				for(var s in attributes[n]) e[n][s] = attributes[n][s];
			} else {
				e[n]=attributes[n];
			}
		}
	}
	if(contents && contents.constructor==Function) {
		tail_tweaks = contents;
		contents = undefined;
	}
  _add_nodes(e, contents);
	if(tail_tweaks)
		tail_tweaks.call(e, e);
	return e;
}







function _add_nodes(e, contents) {
  if(!contents) return;
	if(contents.constructor!=Array) contents=[contents];
	for(var i=0; i<contents.length; i++) {
    var item = contents[i];
		if(item === undefined) continue; // Should never happen, but... you know the drill.
		if(item.nodeType) {
			e.appendChild(item);
		} else {
			if(name=="input") {
				alert("Can't add node to element of type '" + name + "'");
			} else {
				e.appendChild(document.createTextNode(item));
			}
		}
	}
  return 1;
}





var popup__detail_container;
function prepare_detail_container() {
	window.onscroll=function() {
		if(popup__detail_container)
			document.body.removeChild(popup__detail_container);
		popup__detail_container = undefined;
	}
}














function show_popup_detail(ndc, desired_width, options) {
	options=options||{};
	var duration=0.5;
	if(undefined != options.popup_duration)
		duration = options.popup_duration;
	var detail_container = popup__detail_container;
	if(detail_container) try {document.body.removeChild(detail_container)} catch(e) {};

	popup__detail_container = detail_container = ndc;
	var onclick_closes = function() {
		new Effect.Shrink(detail_container.id, {duration: duration, direction: "center"});
		if(options.onclose) options.onclose();
	}
	if(options.closeWidget) {
		options.closeWidget.onclick = onclick_closes;
	}

	var anchor_p = document.createElement("p");
	anchor_p.style.textAlign="center";
	if(options.footer_extra) {
		for(var i=0; i<options.footer_extra.length; i++)
			anchor_p.appendChild(options.footer_extra[i]);
	}
	if(!options.closeWidget) {
		var close_el = document.createElement("button");
		//close_el.type="button";
		close_el.onclick = onclick_closes;
		close_el.appendChild(document.createTextNode("Close"));
		anchor_p.appendChild(close_el);
	}
	detail_container.appendChild(anchor_p);
	var de = document.documentElement;
	var w = window.innerWidth || self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
	var h = window.innerHeight || self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight;

	detail_container.style.position='fixed';
	detail_container.style.display="none";
  detail_container.style.zIndex=100;
	if(desired_width)
		detail_container.style.width = desired_width;
	if(options.be_square)
		detail_container.style.height = detail_container.style.width;
	detail_container.id="pseudo-popup";
	document.body.appendChild(detail_container);
	detail_container.style.left = Math.round((w - Element.getWidth(detail_container)) / 2 ) + "px";
	detail_container.style.top = Math.round((h - Element.getHeight(detail_container)) / 2 ) + "px";
	new Effect.Grow(detail_container.id, {duration: duration, direction: "center"});
}

















function unhtml(content_to_decode, preserve_tags) {

  if(preserve_tags)
    content_to_decode =
      content_to_decode.replace(/</g, "&lt;").replace(/>/g, "&gt;");

	var span = document.createElement("span");
	span.innerHTML=content_to_decode;
	return(span.innerText || span.textContent);
}





function convert_html_entities(content_to_decode) {
	var span = document.createElement("span");
	span.innerHTML=content_to_decode;
	return span.innerHTML;
}







var rlbns__timeouts={};
function run_late_but_not_simultaneously(c, time) {
	var timeout = rlbns__timeouts[c];
	if(timeout) clearTimeout(timeout);
	rlbns__timeouts[c] = setTimeout(c, time);
	return rlbns__timeouts[c];
}




function _bind_to_any(t, f) { // Utility.
	return function() {return f.apply(t, arguments)};
}






var _utils_prototypes = {
	getElementsByClassName: function(strClassName){
		if(!strClassName) return [];
		var arrElements = this.all;
		var arrReturnElements = new Array();
		strClassName = strClassName.replace(/-/g, "\-");
		var oRegExp = new RegExp("(^|\s)" + strClassName + "(\s|$)");
		var oElement;
		for(var i=0; i<arrElements.length; i++){
			oElement = arrElements[i];
			if(oRegExp.test(oElement.className)){
				arrReturnElements.push(oElement);
			}
		}
		return (arrReturnElements)
	},
	stripSuffix: function(s) {
		 if(this.indexOf(s)==0) return this.substring(s.length);
		 return;
	 }
};

	if(!broken_windows_browser) {
		if(!HTMLElement.prototype.getElementsByClassName) 
			HTMLElement.prototype.getElementsByClassName = _utils_prototypes.getElementsByClassName;
		if(!String.prototype.stripSuffix) 
			String.prototype.stripSuffix = _utils_prototypes.stripSuffix;
	}








function _u_prototype() {
	var name = arguments[0];
	var a = [];
	for(var i=1; i<arguments.length; i++)
		a[i-1]=arguments[i];
	if(!this[name])
		this[name] = _utils_prototypes[name];
	return this[name].apply(this, a);
}





function ordinal(n) {
  var end = 'th';
  if(n % 100 < 10 || n % 100 > 20) {
    switch(n % 10) {
      case 1: end = 'st'; break;
      case 2: end = 'nd'; break;
      case 3: end = 'rd'; break;
    }
  }

  return end;
}





var month_names = ['January', 'February', 'March',
                   'April', 'May', 'June',
                   'July', 'August', 'September',
                   'October', 'November', 'December'];




var month_numbers = ['01', '02', '03',
                     '04', '05', '06',
                     '07', '08', '09',
                     '10', '11', '12'];






function ISO8601_to_GB(dt) {
	var d_t = dt.split(/[T ]/);
	d_t[0] = d_t[0].split(/-/).reverse().join("/");
	return d_t.reverse().join(" ");
}
























function merge_node_list(top_element, build_nodes, node_to_uid, detect_change, objects_by_uid, sort_function, on_delete, on_add, on_no_change) {
  var cn = top_element.childNodes;
  // Pass 1: remove dirty nodes
  var skip_uids = {};
  for(var i=cn.length-1; i>=0; i--) {
    var element_to_consider = cn.item(i);
    var uid = node_to_uid(element_to_consider);
    if(!uid) continue;
    var o = objects_by_uid[uid];
    if(o && !detect_change(element_to_consider, o)) {
      skip_uids[uid] = 1;
      if(on_no_change)
        on_no_change.call(element_to_consider);
    } else {
      if(on_delete) {
        if(on_delete.call(element_to_consider))
          top_element.removeChild(element_to_consider);
      } else {
        top_element.removeChild(element_to_consider);
      }
    }
  }

  // Pass 2: add fresh nodes
  for(var uid in objects_by_uid)
    if(!skip_uids[uid])
      binary_insert(top_element, sort_function, objects_by_uid[uid], build_nodes, on_add);
}









function binary_search(top_element, sort_function, o) {
  var cn = top_element.childNodes;
  var top = cn.length; // Note that this is just past the end.
  var bottom = 0;
  if(bottom == top) return 0; // This covers the zero-content scenario.

  var last_position = -1;
  var test_position = Math.round((top+bottom) / 2);
  if(test_position == top) {
    


    test_position--;
  }
  var i=0;
  do {
    var e = cn.item(test_position);
    var result = sort_function(e, o);
    if(result>0) {
      // In correct order, ie we're at or past the bottom.
      bottom = test_position + 1;
    } else if(result<0) {
      // Out of order
      top = test_position - 1;
    } else {
      // If == 0, might as well abort.
      break;
    }

    last_position = test_position;
    test_position = Math.round((top+bottom) / 2);
    i++;
  } while(test_position != last_position && test_position < cn.length && i<32);

  return test_position;
}






function binary_insert(top_element, sort_function, o, build_nodes, on_add) {
  var cn = top_element.childNodes;
  var insertion_point = binary_search(top_element, sort_function, o);
  var a = build_nodes(o);
  if(insertion_point >= cn.length) {
    for(var i=0; i<a.length; i++) {
      top_element.appendChild(a[i]);
      if(on_add) on_add.call(a[i]);
    }
  } else {
    var add_before = cn.item(insertion_point);
    for(var i=0; i<a.length; i++) {
      top_element.insertBefore(a[i], add_before);
      if(on_add) on_add.call(a[i]);
    }
  }
}













function build_chain(values, f, tf, sleep_ms) {
	tf = tf || function() {};
	function _build_tf(v, otf) {
    if(sleep_ms) {
      function to_call() {
        f(v, otf);
      }
      return function() {
        setTimeout(to_call, sleep_ms); 
      };
    } else {
      return function() {
        f(v, otf);
      };
    }
	}
	for(var i=values.length - 1; i>=0; i--)
		tf = _build_tf(values[i], tf);
	return tf;
}











function chain(values, f, tf, sleep_ms) {
	return build_chain(values, f, tf, sleep_ms)();
}
















function build_function_chain(functions, tf) {
	tf = tf || function() {};
	function _build_tf(f, otf) {
		return function() {
			f(otf)
		};
	}
	for(var i=functions.length - 1; i>=0; i--)
		tf = _build_tf(functions.item(i), tf);
	return tf;
}
