for(i=0;i<imglist.length;i++)
{
	imgs[i] = new Image();
	imgs[i].src = imglist[i];
}

function rotator()
{
	w = $('#rotator').css('width');
	w = parseInt(w.replace(/px/gi, ''));

	img = document.createElement('img');
	img.setAttribute('id', 'rotator-second');
	img.style.position = 'absolute';
	img.style.top = '0';
	img.style.left = '0';
	img.style.maxWidth = $('#rotator').css('width');
	document.getElementById("rotator").appendChild(img);
	
	img = document.createElement('img');
	img.setAttribute('id', 'rotator-first');
	img.style.position = 'absolute';
	img.style.top = '0';
	img.style.left = '0';
	img.style.maxWidth = $('#rotator').css('width');
	document.getElementById("rotator").appendChild(img);
	
	div = document.createElement('div');
	div.setAttribute('id', 'rotator-background');
	div.style.position = 'absolute';
	div.style.background = '#000';
	div.style.width = '578px';
	div.style.bottom = '0';
	div.style.left = '12px';
	div.style.color = '#000';
	div.style.fontFamily = 'Verdana';
	div.style.fontSize = '10px';
	div.innerHTML = labels[0];
	div.style.padding = '10px';
	document.getElementById("rotator").appendChild(div);
	$('#rotator-background').css('opacity', 0.6);
	$('#rotator-background').hide();
	
	div = document.createElement('div');
	div.setAttribute('id', 'rotator-label');
	div.style.position = 'absolute';
	div.style.width = '578px';
	div.style.bottom = '0';
	div.style.left = '12px';
	div.style.color = 'white';
	div.style.fontFamily = 'Verdana';
	div.style.fontSize = '10px';
	div.innerHTML = labels[0];
	div.style.padding = '10px';
	document.getElementById("rotator").appendChild(div);
	$('#rotator-label').hide();

	rotate(0);
	$("#rotator").bind("mouseenter",function(){
      $('#rotator-label').slideDown(); 
      $('#rotator-background').slideDown(); 
    }).bind("mouseleave",function(){
      $('#rotator-label').slideUp(); 
      $('#rotator-background').slideUp(); 
    });
}

function last(c)
{
c--;
if(c==-1)
return imglist.length-1;
else
return c;
}

function rotate(c)
{
	$('#rotator-first').show();
	$('#rotator-first').attr('src', imgs[last(c)].src);
	$('#rotator-second').attr('src', imgs[c].src);
	
	curr = c;
	
	if($("#rotator-label").is(":hidden") == false)
	{
		$("#rotator-label").slideUp('normal',function(){
		$('#rotator-label').html(labels[curr]);
		$('#rotator-label').slideDown();
	   });
		$('#rotator-background').slideUp('normal',function(){
		$('#rotator-background').html(labels[curr]);
		$('#rotator-background').slideDown();
	   }); 
	}
	else
	{
		$('#rotator-background').html(labels[curr]);
		$('#rotator-label').html(labels[curr]);

	}
	
	$('#rotator-first').fadeOut('slow');
	
	if(c==imglist.length-1)
	c = -1;
	
	setTimeout('rotate('+(c+1)+')', 8000);
}
window.onload = rotator;