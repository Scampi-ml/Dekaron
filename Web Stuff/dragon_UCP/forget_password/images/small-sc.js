



var small_screen = (screen.availWidth <= 480);





if(location.href.match(/simulate-iphone-screen/) || document.cookie.match(/simulate-iphone-screen/) ) {
  small_screen = true;

  
  var needed_stylesheets = [];
  var ls = document.head.getElementsByTagName("link");
  for(var i=0; i<ls.length; i++)
    if(ls.item(i).rel == "stylesheet" && ls.item(i).href.match(/-iphone.css/))
      needed_stylesheets.push(ls.item(i).href);

  
  for(var i=ls.length - 1; i>=0; i--)
    if(ls.item(i).className && ls.item(i).className.match(/html-head-css-large/))
      document.head.removeChild(ls.item(i));

  
  ls = document.head.getElementsByTagName("style");
  for(var i=ls.length - 1; i>=0; i--)
    if(ls.item(i).className && ls.item(i).className.match(/html-head-css-large/))
      document.head.removeChild(ls.item(i));

  
  for(var i=0; i<needed_stylesheets.length; i++)
    document.head.appendChild(
      _mkel("link", {
        rel: "stylesheet", 
        type: "text/css", 
        href: needed_stylesheets[i].replace(/-iphone.css/, "-iphone-inner.css")
      })
    );

  
  document.head.appendChild(
    _mkel("link", {
      rel: "stylesheet", 
      type: "text/css", 
      href: "/iphone-width-force.css"
    })
  );
  
}
