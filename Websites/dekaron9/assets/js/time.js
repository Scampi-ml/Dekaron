function CurrentTime(containerNode, startTimeStamp, timeFormat)
{
    var self = this,
        timer,
        weekDays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        now = new Date(),
        prevTickTimeStamp,
        currTickTimeStamp;


    function addLeadingZero(v) {
        var s = v < 0 ? "-" : "";
        v  = Math.abs(v);

        return s + (v < 10 ? "0" + v : v);
    }

    function generateTimeString24H() {
    return addLeadingZero(now.getUTCHours()) + ":" + addLeadingZero(now.getUTCMinutes()) + ":"
         + addLeadingZero(now.getUTCSeconds()) + ", " + weekDays[now.getUTCDay()] + " " + addLeadingZero(now.getUTCDate()) + ", " + months[now.getUTCMonth()] + " "
         + now.getUTCFullYear();
    }

    function generateTimeString12H() {
    var hours = now.getUTCHours(),
        dayPart = "AM";

    if (hours > 11) {
        hours -= 12;
        dayPart = "PM";
    }
    if (hours == 0) {
        hours = 12;
    }


    return addLeadingZero(hours) + ":" + addLeadingZero(now.getUTCMinutes()) + ":"
         + addLeadingZero(now.getUTCSeconds()) + " " + dayPart + ", " + weekDays[now.getUTCDay()] + " " + addLeadingZero(now.getUTCDate()) + ", " + months[now.getUTCMonth()] + " "
         + now.getUTCFullYear();
    }

    function secondTick() {
        currTickTimeStamp = new Date().getTime();
        now.setTime((currTickTimeStamp - prevTickTimeStamp) + startTimeStamp);

		$("#currentTime").html(self.timeFormat == CurrentTime.F24 ? generateTimeString24H() : generateTimeString12H());
    }

    this.timeFormat = typeof timeFormat == "undefined" ? CurrentTime.F24 : timeFormat;

    this.start = function () {
        clearInterval(timer);
        prevTickTimeStamp = (new Date()).getTime();
        timer = setInterval(secondTick, 1000);
    }
}

CurrentTime.F24 = 0;
CurrentTime.F12 = 1;

CurrentTime.setTimeFormat = function (timeFormat) {
    this.timeFormat = timeFormat;
}

CurrentTime.getTimeFormat = function () {
    return this.timeFormat;
}

$(document).ready(function()
{
	if (!Date.now) {
		Date.now = function() { return new Date().getTime(); };
	}
	
	var currentDate = Date.now();
	
	var currentTime = currentDate.getTime();
	
	var localOffset = (-1) * selectedDate.getTimezoneOffset() * 60000;
	
	var stamp = Math.round(new Date(currentTime + localOffset).getTime() / 1000);
	
	
	var currentTime = new CurrentTime(document.getElementById("currentTime").childNodes[0], stamp, CurrentTime.F12)
	currentTime.start();
});	