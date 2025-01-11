(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};

		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);

			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;

			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};

			$self.data('countTo', data);

			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);

			// initialize the element with the starting value
			render(value);

			function updateTimer() {
				value += increment;
				loopCount++;

				render(value);

				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}

				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;

					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}

			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.text(formattedValue);
			}
		});
	};

	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};

	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

var Count1 = 0;

var action = new Array();
action[0] = "Character Name ....";
action[1] = "Guild Name ....";
action[2] = "Health Point ....";
action[3] = "Magic Point ....";
action[4] = "Stat: Str ....";
action[5] = "Stat: Dex ....";
action[6] = "Stat: Heal ....";
action[7] = "Stat: Spr ....";
action[8] = "Shield ....";
action[9] = "Class ....";
action[10] = "Adventure Points ....";
action[11] = "Level ....";
action[12] = "Skill Clear Count ....";
action[13] = "Stat Clear Count ....";
action[14] = "PK Count ....";
action[15] = "Chaotic Level ....";
action[16] = "PVP: Points ....";
action[17] = "PVP: Win Record ....";
action[18] = "PVP: Lose Record ....";
action[19] = "Accessorys ....";
action[20] = "Weapons ....";
action[21] = "EXP Amulet ....";
action[22] = "Wings ....";
action[23] = "Helmet ....";
action[24] = "Armor ....";
action[25] = "Pants ....";
action[26] = "Gloves ....";
action[27] = "Boots ....";
action[28] = "Shield ....";
action[29] = "Quick Slots ....";
action[30] = "Costume ....s";
action[31] = "Mounts ....";
action[32] = "Creating page ....";
action[33] = "Saving cache ....";
action[34] = "Loading Cache ....";
action[35] = "Loading Page ....";
action[36] = "Done!";
action[37] = "Done!";
action[38] = "Done!";
action[39] = "Done!";
action[40] = "Done!";
action[41] = "Done!";
action[42] = "Done!";
action[43] = "Done!";


$('.timer').countTo({
	from: 10,
	to: -0,
	speed: 10000,
	refreshInterval: 250,
	formatter: function (value, options) {
		return value.toFixed(options.decimals);
	},
	onUpdate: function (value)
	{
		if(action[Count1] === 'undefined')
		{
			$('.update').html('done!');		
		}
		else
		{
			$('.update').html('' + action[Count1] + '');
		}
		Count1++;
	},	
	onComplete: function (value) {
		//console.debug(this);
		//alert('DONE!');
	}
});
