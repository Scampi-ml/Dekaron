var Groups = {
	identifier: "groups",
	Links: {
		remove: "admin/aclmanager/groupDelete/",
		create: "admin/aclmanager/groupCreate/",
		save: "admin/aclmanager/groupSave/",
	},
	remove: function(id, element){
		var identifier = this.identifier,
			removeLink = this.Links.remove;

		UI.confirm("Do you really want to delete this group?", "Yes", function(){
			$("#" + identifier + "_count").html(parseInt($("#" + identifier + "_count").html()) - 1);

			$(element).parents("tr").slideUp(300, function(){
				$(this).remove();
			});

			$.get(Config.URL + removeLink + id);
		});
	},
	add: function(){
		var id = this.identifier;

		if($("#add_" + id).is(":visible")){
			$("#add_" + id).fadeOut(150, function()
			{
				$("#main_" + id).fadeIn(150);
			});
		}else{
			$("#main_" + id).fadeOut(150, function()
			{
				$("#add_" + id).fadeIn(150);
			});
		}
	},
	create: function(form){
		var values = {csrf_token_name: Config.CSRF};

		$(form).find("input, select").each(function(){
			if($(this).attr("type") != "submit" && $(this).attr("type") != "checkbox"){
				values[$(this).attr("name")] = $(this).val();
			}else if($(this).attr("type") == "checkbox"){
				values[$(this).attr("name")] = this.checked;
			}
		});

		$.post(Config.URL + this.Links.create, values, function(data){
			console.log(data);
			eval(data);
		});
	},
	save: function(form, id){
		var values = {csrf_token_name: Config.CSRF};

		$(form).find("input, select").each(function(){
			if($(this).attr("type") != "submit" && $(this).attr("type") != "checkbox"){
				values[$(this).attr("name")] = $(this).val();
			}else if($(this).attr("type") == "checkbox"){
				values[$(this).attr("name")] = this.checked;
			}
		});


		$.post(Config.URL + this.Links.save + id, values, function(data){
			console.log(data);
			eval(data);
		});
	},
	removeAccount: function(name, field, groupId, isYourself){
		var proceed = function(){
			$(field).transition({rotateX: '90deg', opacity:0 }, 500, function(){
				$(this).hide();
			});

			if(name){
				var data = {
					name: name,
					groupId: groupId,
					csrf_token_name: Config.CSRF
				};

				$.post(Config.URL + "admin/aclmanager/removeMember", data);
			}
		};

		if(isYourself){
			UI.confirm("<div style='margin-bottom:10px;font-size:16px;'>Are you sure you want to remove yourself from this group?</div><div style='margin-bottom:10px;font-size:10px;color:red;'>You may revoke your admin panel access by doing so.</div>", "Yes", proceed);
		}else{
			proceed();
		}
	},

	addAccount: function(field, groupId){
		field = $(field);

		UI.confirm('<input type="text" id="add_member_name" placeholder="Enter username..." autofocus/>', 'Add', function(){
			var name = $("#add_member_name").val();

			var newItem = $('<a href="javascript:void(0)" onClick="Groups.removeAccount(\'' + name + '\', this, ' + groupId + ')">\
								<img src="' + Config.URL + 'application/images/icons/delete.png" />\
								' + name + '\
							</a>');

			newItem.insertBefore(field);

			var data = {
				name: name,
				groupId: groupId,
				csrf_token_name: Config.CSRF
			};

			$.post(Config.URL + "admin/aclmanager/addMember/" + groupId, data, function(response){
				if(response == "invalid"){
					UI.alert("The account doesn't exist");
					Groups.removeAccount(false, newItem);
				}
			});
		});
	}
}