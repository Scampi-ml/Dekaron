var Store = {
	
	toggleGroup: function(field)
	{
		var group = $(field).parent().next('.item_group');

		if(group.is(":visible"))
		{
			$(field).html('[+]').attr('data-tip', 'Show group');
		}
		else
		{
			$(field).html('[-]').attr('data-tip', 'Hide group');
		}

		group.slideToggle(300);
	},

	toggleAllGroups: function(field)
	{
		var groups = $(field).parents('.realm_items').find('.hide_group');

		if(/\[\+\]/.test($(field).html()))
		{
			$(field).html('[-] Hide all item groups');

			groups.each(function()
			{
				var group = $(this).parent().next('.item_group');
				$(this).html('[-]').attr('data-tip', 'Hide group');
				group.slideDown(300);
			});
		}
		else
		{
			$(field).html('[+] Show all item groups');

			groups.each(function()
			{
				var group = $(this).parent().next('.item_group');
				$(this).html('[+]').attr('data-tip', 'Show group');
				group.slideUp(300);
			});
		}
	},

	/**
	 * Filter object, holds filtering functionality
	 */
	Filter: {
		 
		showVote: true,
		showDonate: true,
		displayQuality: "ALL",
		nameFilter: "",

		/**
		 * Toggle the display of voting items
		 * @param Object element
		 */
		toggleVote: function(element)
		{
			element = $(element);

			if(element.hasClass("nice_active"))
        	{
                // Toggled again: show both
                this.showVote = true;
                this.showDonate = false;
                element.removeClass("nice_active");
	        }
    	    else
        	{
                // Show only vote
                this.showVote = true;
                this.showDonate = false;
                element.addClass("nice_active");
	        }

			this.filterByPriceType();
		},

		/**
		 * Toggle the display of donation items
		 * @param Object element
		 */
		toggleDonate: function(element)
		{
			element = $(element);

			if(element.hasClass("nice_active"))
	        {
                // Toggled again: show both
                this.showDonate = true;
                this.showVote = false;
                element.removeClass("nice_active");
    	    }
        	else
	        {
                // Show only donate
                this.showDonate = true;
                this.showVote = false;
                element.addClass("nice_active");
    	    }

			this.filterByPriceType();
		},

		/**
		 * Add filter states to all items
		 */
		initialize: function()
		{
			$("#store_realms .store_item").each(function()
		 	{
				$(this).attr({
					"data-filter-price": 1,
					"data-filter-quality": 1,
					"data-filter-name": 1
				});
			});
		},

		/**
		 * Show items which data-filters are all positive
		 */
		filter: function()
		{
			var show;

			$("#store_realms .store_item").each(function()
		 	{
		 		show = false;

		 		// Did it pass all filters?
		 		if($(this).attr("data-filter-price") == 1
		 		&& $(this).attr("data-filter-quality") == 1
		 		&& $(this).attr("data-filter-name") == 1)
		 		{
		 			show = true;
		 		}

		 		// Whether or not to show
		 		if(show)
		 		{
		 			$(this).slideDown(300);
		 		}
		 		else
		 		{
					$(this).slideUp(300);
		 		}
		 	});
		},

		/**
		 * Filter the items based on the price type toggles
		 */
		filterByPriceType: function()
		{
			$("#store_realms .store_item").each(function()
		 	{
		 		var hasVp = false;
					hasDp = false;
					canHide = true;

		 		// Filter based on vp / dp toggling
		 		$(this).find(".store_buttons a").each(function()
	 			{
	 				value = $(this).html().replace(/<.*>/, "");
	 				price = parseInt(value.replace(/[^0-9]+/, ""));

	 				if(/DP/.test(value))
			 		{
			 			hasDp = true;
			 		}
			 		else
			 		{
			 			hasVp = true;
			 		}
	 			});

		 		// Does the item have VP option and is VP enabled
	 			if(hasVp && Store.Filter.showVote && canHide)
	 			{
	 				canHide = false;
	 			}
	 			
	 			// Does the item have DP option and is DP enabled
	 			if(hasDp && Store.Filter.showDonate && canHide)
	 			{
	 				canHide = false;
	 			}
	 			
	 			// Should we hide it?
	 			if(canHide)
	 			{
	 				$(this).attr("data-filter-price", 0);
	 			}
	 			else
	 			{
	 				$(this).attr("data-filter-price", 1);
	 			}
		 	});

		 	Store.Filter.filter();
		},

		/**
		 * Toggle the visibility of a realm
		 * @param Int id
		 */
		toggle: function(id)
		{
			var field = $("#realm_items_" + id);

			if(field.is(":visible"))
			{
				$("#realm_indicator_" + id).html("[+]");
				field.fadeOut(300);
			}
			else
			{
				$("#realm_indicator_" + id).html("[-]");
				field.fadeIn(300);
			}
		},

		/**
		 * Filter the items based on the name matches
		 */
		filterByName: function()
		{
			var name, regex = new RegExp(this.nameFilter, "i");

			$("#store_realms .store_item").each(function()
		 	{
		 		// Filter based on vp / dp toggling
		 		name = $(this).find(".item_name").html();
	 			
	 			// Should we hide it?
	 			if(!regex.test(name))
	 			{
	 				$(this).attr("data-filter-name", 0);
	 			}
	 			else
	 			{
	 				$(this).attr("data-filter-name", 1);
	 			}
		 	});

		 	Store.Filter.filter();
		},

		/**
		 * Change the name filter
		 * @param String text
		 */
		setName: function(text)
		{
			text = text.replace(/[^A-Za-z0-9]+/, "");

			this.nameFilter = text;

			this.filterByName();
		},

		/**
		 * Change the quality filter
		 * @param Int value
		 */
		setQuality: function(value)
		{
			this.displayQuality = value;

			this.filterByQuality();
		},

		/**
		 * Filter the items based on their item quality
		 */
		filterByQuality: function()
		{
			$("#store_realms .store_item").each(function()
		 	{
		 		if(Store.Filter.displayQuality == "ALL")
		 		{
		 			$(this).attr("data-filter-quality", 1);
		 		}
		 		else
		 		{
		 			// Filter based on vp / dp toggling
			 		item = $(this).find(".item_name");
		 			
		 			// Should we hide it?
		 			if(item.hasClass("q" + Store.Filter.displayQuality))
		 			{
		 				$(this).attr("data-filter-quality", 1);
		 			}
		 			else
		 			{
		 				$(this).attr("data-filter-quality", 0);
		 			}
		 		}
		 	});

		 	Store.Filter.filter();
		},

		/**
		 * Sort the items
		 * @param String value
		 */
		sort: function(value)
		{
			if(typeof Store.Filter.Sorting[value] != "undefined")
			{
				// Loop through all groups
				$('#store_realms .item_group').each(function()
				{
					// Sort the items with in them
					$(this).find('.store_item').sortElements(Store.Filter.Sorting[value]);
				});

				// Sort all direct child elements (in other words; not in groups)
				$('#store_realms > .store_item').sortElements(Store.Filter.Sorting[value]);
			}
		},

		/**
		 * Holds all sorting algorithms
		 */
		Sorting: {

			standard: function(a, b)
			{
				return parseInt($(a).attr("id").replace("item_", "")) > parseInt($(b).attr("id").replace("item_", "")) ? 1 : -1;
			},

			name: function(a, b)
			{
				return $(a).find(".item_name").html() > $(b).find(".item_name").html() ? 1 : -1;
			},

			priceVp: function(a, b)
			{
				return $(a).find(".vp_price_value").html() > $(b).find(".vp_price_value").html() ? 1 : -1;
			},

			priceDp: function(a, b)
			{
				return $(a).find(".dp_price_value").html() > $(b).find(".dp_price_value").html() ? 1 : -1;
			},

			quality: function(a, b)
			{
				return parseInt($(a).find(".item_name").attr("class").replace("item_name q", "")) < parseInt($(b).find(".item_name").attr("class").replace("item_name q", "")) ? 1 : -1;
			}
		},

		/**
		 * Fade out buttons of items which the user can't afford
		 */
		 updatePrices: function()
		 {
		 	var value, price;

		 	$("#store_realms .store_item").each(function()
		 	{
		 		$(this).find(".store_buttons a").each(function()
	 			{
	 				value = $(this).html().replace(/<.*>/, "");
	 				price = parseInt(value.replace(/[^0-9]+/, ""));

	 				if(/DP/.test(value))
			 		{
			 			if(price > Store.Customer.dp)
			 			{
			 				$(this).fadeTo(300, 0.5);
			 			}
			 			else
			 			{
			 				$(this).fadeTo(300, 1);
			 			}
			 		}
			 		else
			 		{
			 			if(price > Store.Customer.vp)
			 			{
			 				$(this).fadeTo(300, 0.5);
			 			}
			 			else
			 			{
			 				$(this).fadeTo(300, 1);
			 			}
			 		}
	 			});
		 	});
		 }
	},

	/**
	 * Customer object, holds economical values
	 */
	Customer: {

		vp: 0,
		dp: 0,

		initialize: function(vp, dp)
		{
			this.vp = vp;
			this.dp = dp;

			Store.Filter.initialize();
		},

		/**
		 * Return points to the customer
		 * @param Int price
		 * @param String priceType
		 */
		add: function(price, priceType)
		{
			this[priceType] += price;

			if($("#info_" + priceType).length)
			{
				$("#info_" + priceType).html(this[priceType]);
			}

			Store.Filter.updatePrices();
		},

		/**
		 * Subtract to the customers money
		 * @param Int price
		 * @param String priceType
		 * @param Function callback
		 */
		subtract: function(price, priceType, callback)
		{
			var old = this[priceType];
			
			this[priceType] -= price;

			if(this[priceType] < 0)
			{
				this[priceType] = old;

				UI.alert("You can't afford this!");
			}
			else
			{
				if($("#info_" + priceType).length)
				{
					$("#info_" + priceType).html(this[priceType]);
				}

				Store.Filter.updatePrices();

				callback();
			}
		}
	},

	/**
	 * Cart object, holds all shop actions
	 */
	Cart: {

		items: {},
		list: [],
		vpCost: 0,
		dpCost: 0,
		count: 0,

		/**
		 * Add an item to the cart
		 * @param Int id
		 * @param Int itemId
		 * @param String name
		 * @param Int price
		 * @param String priceType
		 * @param String realm
		 */
		add: function(id, itemId, name, price, priceType, realm, realmId, quality, tooltip)
		{
			name = name.replace(/\//, "");
			realm = realm.replace(/\//, "");

			Store.Customer.subtract(price, priceType, function()
			{
				if(priceType == "vp")
				{
					Store.Cart.vpCost += price;
				}
				else if(priceType == "dp")
				{
					Store.Cart.dpCost += price;
				}

				var itemObject = {
					id: id,
					price: price,
					priceType: priceType
				};

				Store.Cart.list.push({id:id, type:priceType});

				Store.Cart.updatePrice();

				$("#cart_item_count").html(Store.Cart.list.length);

				var isInCart = Store.Cart.isInCart(id, priceType);
				
				if(isInCart)
				{
					var countField = $("#cart_item_count_" + isInCart),
						itemCount;
					
					if(countField.html().length == 0)
					{
						itemCount = 2;
					}
					else
					{
						itemCount = parseInt(countField.html().replace("x ", "")) + 1;
					}

					countField.html("x " + itemCount);
					Store.Cart.count++;
				}
				else
				{
					Store.Cart.items[Store.Cart.count] = itemObject;

					$("#empty_cart").fadeOut(50, function()
					{
						var tooltipHTML = (tooltip) ? 'data-realm="' + realmId +'" rel="item=' + itemId +'"' : '';

						var itemHTML = '<article class="store_item" id="cart_item_' + Store.Cart.count + '">' +
											'<div class="item_price">' +
												'<img src="' + Config.URL + 'application/images/icons/' + ((priceType == "vp") ? "lightning" : "coins") + '.png" align="absmiddle" />' +
												price + ((priceType == "vp") ? " VP" : " DP") +
											'</div>' +
											'<a href="javascript:void(0)" onClick="Store.Cart.remove(' + id + ', ' + Store.Cart.count + ')" class="delete_item">' +
												'<img src="' + Config.URL + 'application/images/icons/delete.png" align="absmiddle" />' +
											'</a>' +
											'<a href="' + Config.URL + 'item/' + realmId + '/' + itemId + '" class="item_name q' + quality  +'" ' + tooltipHTML + '>' +
												name + ' <span id="cart_item_count_' + Store.Cart.count + '"></span>' + 
											'</a>' +
											'<div class="item_realm">' + realm + '</div>' +
											'<div class="clear"></div>' +
										'</article>';

						$("#cart_items").append(itemHTML);
						$("#cart_item_" + Store.Cart.count).slideDown(150, function()
						{
							Tooltip.refresh();
						});

						Store.Cart.count++;
					});
				}
			});
		},

		/**
		 * Check if the item exists in the cart already
		 * @param Int id
		 * @param String priceType
		 * @return Boolean
		 */
		isInCart: function(id, priceType)
		{
			for(i in this.items)
			{
				try
				{
					if(id == this.items[i].id
					&& priceType == this.items[i].priceType)
					{
						return i;
					}
				}
				catch(error)
				{
					// ...
				}
			}

			return false;
		},

		/**
		 * Remove an item from the cart
		 * @param Int id
		 * @param Int countId
		 */
		remove: function(id, countId)
		{
			var priceType;

			try
			{
				var itemCount;

				if($("#cart_item_count_" + countId).html().length != 0)
				{
					itemCount = parseInt($("#cart_item_count_" + countId).html().replace("x ", ""));
				}
				else
				{
					itemCount = 1;
				}

				this[this.items[countId].priceType + "Cost"] -= this.items[countId].price * itemCount;

				// Return the customer money
				Store.Customer.add(this.items[countId].price * itemCount, this.items[countId].priceType);

				priceType = this.items[countId].priceType;

				// Delete the object
				this.items[countId] = null;
			}
			catch(error)
			{
				// ...
			}

			// Remove it from the list array
			var n;

			for(var i = 0;i < itemCount;i++)
			{
				for(n in Store.Cart.list)
				{
					if(Store.Cart.list[n].id == id
					&& (Store.Cart.list[n].type == priceType || typeof priceType == "undefined"))
					{
						this.list.splice(n, 1);
					}
				}
			}

			this.updatePrice();

			$("#cart_item_count").html(Store.Cart.list.length);

			// Remove the element
			$("#cart_item_" + countId).slideUp(150, function()
			{
				$(this).remove();

				if(Store.Cart.list.length == 0)
				{
					setTimeout(function()
					{
						if(Store.Cart.list.length == 0)
						{
							$("#empty_cart").fadeIn(150);
						}
					}, 500);
				}
			});
		},

		/**
		 * Submit the cart values to the back end
		 * @param Element button
		 */
		checkout: function(button)
		{
			var cartList = JSON.stringify(this.list);

			// Change the button state to "Loading..."
			$(button).addClass("nice_active").removeAttr("href").removeAttr("onClick").html("Loading...");

			// Submit to the back end
			$.post(Config.URL + "store/checkout", {cart: cartList, csrf_token_name: Config.CSRF}, function(data)
			{
				$("#store").fadeOut(150, function()
				{
					// Restore the button
					$(button).removeClass("nice_active").attr("href", "javascript:void(0)").attr("onClick", "Store.Cart.checkout(this)").html("Checkout");

					// Display the content
					$("#checkout").html(data).fadeIn(150, function()
					{
						Tooltip.refresh();
					});
				});
			});
		},

		/**
		 * Submit the cart and the characters to the final payment gate
		 */
		pay: function()
		{
			UI.confirm("Are you sure you want to buy these items?", "Yes", function()
			{
				$("[data-id]").attr("data-available", "1");

				for(i in Store.Cart.list)
				{
					if(typeof Store.Cart.list[i].character != "undefined")
					{
						delete Store.Cart.list[i]["character"];
					}

					$("[data-id=\"" + Store.Cart.list[i].id + "\"]").each(function()
					{
						if($(this).attr("data-available") == "1"
						&& typeof Store.Cart.list[i].character == "undefined")
						{
							$(this).attr("data-available", "0");
							Store.Cart.list[i].character = $(this).val();
							console.log(Store.Cart.list[i].character)
						}
					});
				}

				var data = JSON.stringify(Store.Cart.list);

				$("#checkout").fadeOut(150, function()
				{
					$("#checkout").html('<center><img src="' + Config.image_path + 'ajax.gif" /></center>').fadeIn(150, function()
					{
						$.post(Config.URL + "store/pay", {data: data, csrf_token_name: Config.CSRF}, function(data)
						{
							$("#store_wrapper").fadeOut(150, function()
							{
								$("#store_wrapper").html(data).fadeIn(150);
							});
						});
					})
				});
			});
		},

		/**
		 * Display the total price
		 */
		updatePrice: function()
		{
			// Hide the total cost if cart is empty
			if(this.list.length == 0)
			{
				this.vpCost = 0;
				this.dpCost = 0;

				setTimeout(function()
				{
					$("#cart_price").fadeOut(300);
				}, 350);
			}

			// Show the total cost if cart is not empty
			else if(!$("#cart_price").is(":visible"))
			{
				setTimeout(function()
				{
					$("#cart_price").fadeIn(300);
				}, 350);
			}

			var vp = $("#vp_price");
			var dp = $("#dp_price");

			if(vp.html() != this.vpCost)
			{
				vp.fadeTo(300, 0, function()
				{
					vp.html(Store.Cart.vpCost);
					vp.fadeTo(300, 1);
				});
			}

			if(dp.html() != this.dpCost)
			{
				dp.fadeTo(300, 0, function()
				{
					dp.html(Store.Cart.dpCost);
					dp.fadeTo(300, 1);
				});
			}
		},

		/**
		 * Return to the original store list view
		 */
		back: function()
		{
			$("#checkout").fadeOut(150, function()
			{
				$("#store").fadeIn(150);
			});
		}
	}
}