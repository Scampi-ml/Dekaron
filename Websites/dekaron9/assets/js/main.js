$(window).load(function()
{
	if($("#slider").length > 0)
	{
		$('#slider').nivoSlider({
			effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
			slices: 15, // For slice animations
			boxCols: 8, // For box animations
			boxRows: 4, // For box animations
			animSpeed: 700, // Slide transition speed
			pauseTime: 7000, // How long each slide will show
			startSlide: 0, // Set starting Slide (0 index)
			directionNav: false, // Next & Prev navigation
			controlNav: false, // 1,2,3... navigation
			controlNavThumbs: false, // Use thumbnails for Control Nav
			pauseOnHover: true, // Stop animation while hovering
			manualAdvance: false, // Force manual transitions
			prevText: 'Prev', // Prev directionNav text
			nextText: 'Next', // Next directionNav text
			randomStart: true, // Start on a random slide
			beforeChange: function(){}, // Triggers before a slide transition
			afterChange: function(){}, // Triggers after a slide transition
			slideshowEnd: function(){}, // Triggers after all slides have been shown
			lastSlide: function(){}, // Triggers when last slide is shown
			afterLoad: function(){} // Triggers when slider has loaded
		});
	}	
});


function convert_to_time_x1500 ( )
{
	secs_x1500 = countdown_x1500;
	
	secs_x1500 = parseInt(secs_x1500);
	hh_x1500 = secs_x1500 / 3600;
	hh_x1500 = parseInt(hh_x1500);
	mmt_x1500 = secs_x1500 - (hh_x1500 * 3600);
	mm_x1500 = mmt_x1500 / 60;
	mm_x1500 = parseInt(mm_x1500);
	ss_x1500 = mmt_x1500 - (mm_x1500 * 60);
	
	if (hh_x1500 > 23)
	{
		dd_x1500 = hh_x1500 / 24;
		dd_x1500 = parseInt(dd_x1500);
		hh_x1500 = hh_x1500 - (dd_x1500 * 24);
	}
	else
	{
		dd_x1500 = 0;
	}
	
	if (ss_x1500 < 10) { ss_x1500 = "0"+ss_x1500; }
	if (mm_x1500 < 10) { mm_x1500 = "0"+mm_x1500; }
	if (hh_x1500 < 10) { hh_x1500 = "0"+hh_x1500; }
	if (dd_x1500 == 0)
	{
		var ret = hh_x1500+" hrs&nbsp;&nbsp;&nbsp;"+mm_x1500+" min&nbsp;&nbsp;&nbsp;"+ss_x1500+" sec";
	}
	else
	{
		if (dd_x1500 > 1)
		{
			var ret = dd_x1500+" days "+hh_x1500+"hrs "+mm_x1500+"mins "+ss_x1500+"secs";
		}
		else
		{
			var ret = dd_x1500+" day "+hh_x1500+"hrs "+mm_x1500+"mins "+ss_x1500+"secs";
		}
	}
 	countdown_x1500--;
	$("#nationwarx1500").html(ret);
}


function updateCClock ( )
{
	var currentTime = new Date ( );
	var currentHours = currentTime.getHours ( );
	var currentMinutes = currentTime.getMinutes ( );
	var currentSeconds = currentTime.getSeconds ( );
	currentHours = ( currentHours < 10 ? "0" : "" ) + currentHours;
	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds ;
	$("#footerClock").html(currentTimeString);
}

$(document).ready(function()
{
	if (typeof variable !== 'undefined') {	
		setInterval('updateCClock()', 10);
		setInterval('convert_to_time_x1500()', 1000);	
		
	}
	UI.initialize();
});