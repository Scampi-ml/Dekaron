





function load_login_captcha(top_element_id, prefix) {
  prefix=prefix||"";

  
  broken_windows_browser=0;
  if(navigator.userAgent.toLowerCase().indexOf("msie")>=0) broken_windows_browser=1;

  var xmlhttp_captcha;
  

  var orsc_fired=false;

  



  function xmlr_statechange_captcha() {
    orsc_fired=true;
    var ready_state;
    var http_status;
    if(xmlhttp_captcha.readyState === undefined) {
      

      ready_state = 4;
      http_status = 200;
    } else {
      ready_state = xmlhttp_captcha.readyState;
      if(ready_state == 4) http_status = xmlhttp_captcha.status;
    }
    
    // if LOADED
    if(ready_state == 4 && http_status == 200) {
      var text_data = xmlhttp_captcha.responseText;

      document.getElementById('captcha-image').src =
        prefix + "/captcha/" + text_data + ".png";
      var cs = document.getElementById('captcha-sound');
      if(cs) {
        cs.href = prefix + "/captcha/" + text_data + ".wav";
      }
      var csb = document.getElementById('captcha-sound-button');
      if(csb) {
        csb.onclick=function() {
          
          var wavURL = prefix + "/captcha/" + text_data + ".wav";
          var csbl = document.getElementById('captcha-sound-block');
          
          csbl.innerHTML = "";
          csbl.innerHTML =
            '<EMBED SRC=' + wavURL + ' HIDDEN="true" AUTOSTART="true" />';
          return false;
        };
      }
      
      document.getElementById('captcha-input').name
        = "captcha-" + text_data;

    } else if(ready_state == 4) {
      alert("HTTP error: "+http_status);
    }
  }

  var uc_timeout;

  




  function update_captcha() {
    uc_timeout = undefined;
    var hide = 1;
    



    function notify_user() {
      document.getElementById('captcha-image').style.visibility =
        hide ? "hidden" : "visible";
      hide = 1 - hide;
    }

    var flash_i = setInterval(notify_user, 500);
    



    function clear_and_reload() {
      clearInterval(flash_i);
      
      hide=0;
      notify_user();
      
      get_captcha();      
    }
    setTimeout(clear_and_reload, 5000);
  }

  



  function get_captcha() {
    



    var is_weird = false;
    if(broken_windows_browser) {
      if(window.XDomainRequest) {
        is_weird = true;
        xmlhttp_captcha = new XDomainRequest();
      } else {
        xmlhttp_captcha = new ActiveXObject("MsXml2.XmlHttp");
      }
    } else {
      xmlhttp_captcha = new XMLHttpRequest();
    }
    if(is_weird) {
      xmlhttp_captcha.onload=xmlr_statechange_captcha;
    } else {
      xmlhttp_captcha.onreadystatechange=xmlr_statechange_captcha;
    }
    var target_url = prefix + "/mkcaptcha.cgi";
    
    if(broken_windows_browser) target_url += "?r=" + Math.random();
    xmlhttp_captcha.open("GET", target_url, true);
    xmlhttp_captcha.send(null);
    
    if(uc_timeout) clearTimeout(uc_timeout);
    uc_timeout = setTimeout(update_captcha, (300-20)*1000);
  }

  
  document.getElementById(top_element_id).innerHTML = '<p style="padding: 0; margin: 0; font-size: 18px; font-weight: bold;">Security Check</p> <p style="font-size: 10.5px;" class="inline-doc">As an added security measure, please enter the letters you see below into the box.</p> <div style="height: 0px; width: 0px" id="captcha-sound-block"> </div> <img id="captcha-image" src="" style="float: left; margin: 0 10px 10px 0;"/> <input id="captcha-input" type="text" name="captcha-" class="captchainput" /> <div style="clear: both;"></div> <p style="float: left; margin-right: 20px;"><img src="' + prefix + '/images/icon_refresh.png" alt="Refresh text" /><a href="#" title="Refresh text" id="captcha-refresh-button">Refresh text</a></p> <p style="float: left;"><img src="' + prefix + '/images/icon_audio.png" alt="Listen to Audio" /><a href="#" title="Listen to Audio" id="captcha-sound-button">Audio version</a></p>';

  document.getElementById("captcha-refresh-button").onclick =
    function() {get_captcha();return false}
  document.getElementById("captcha-sound-button").onclick =
    function() {return false}
  
  get_captcha();
  
  if(!orsc_fired) xmlr_statechange_captcha();
}
