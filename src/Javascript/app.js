(function(group6) {

	group6(window.jQuery, window, document);

}(function($, window, document) {

	$(function() {

		$("div#loginForm").append(

			$("<h3/>").text("Sign In"),
			$("<form/>", {
				//action: '#',
				method: 'post'
			}).append(
				$("<input/>", {
				type: 'text',
				id: 'username',
				name: 'username',
				placeholder: 'username'
				}), 
				$("<input/>", {
				type: 'password',
				id: 'password',
				name: 'password',
				placeholder: 'password'
				}),
				$("<br/>"), $("<input/>", {
				type: 'submit',
				id: 'submit',
				value: 'Submit'
				})
			)		
		);

		var form = $("#loginForm");
			form.on({

				"submit": function(e) {
                    e.preventDefault();

                    var username = $(this).find("[name='username']").val();
                    var password = $(this).find("[name='password']").val();

                    var key = accessKey().done(function(data){

                    	authenticate(username, password, data.key)
                    	.done(function(data){
                    		
                    		var json = $.parseJSON(data);
                    		
                    		$.each(json, function(idx, obj) {
								
								$("#authorized").text("User profile url: " + obj);

							});
                    	})
                    	.fail(function(data){
                    		console.log(data);

                    		var json = $.parseJSON(data.responseText);

                    		console.log(json);
                    		
                    		$.each(json, function(idx, obj) {

                    			if(obj==="/register"){

                    				window.location.href = obj;

                    			} else {
                    				
                    				$("#authorized").text(obj);

                    			}
								
							});
                    	});
                    });
                                        
                }

		});

	});

	function authenticate(username, password, accessKey) {
		var key = accessKey;
		var formData = {username:username, password:password};
		return $.ajax({
			url: "/authenticate",
			type: "post",
			headers: {
				"Authorization": key
			},
			data: formData
		});
	}

	function accessKey() {
		var key = accessKey;
		
		return $.ajax({
			url: "/access",
			type: "get"
		});
	}

}));