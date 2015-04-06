(function(group6) {

	group6(window.jQuery, window, document);

}(function($, window, document) {

	$(function() {

		$("div#loginForm").append(
			// Creating Form Div and Adding <h2> and <p> Paragraph Tag in it.
			$("<h3/>").text("Sign In"),
			$("<form/>", {
				//action: '#',
				method: 'post'
			}).append(
				// Create <form> Tag and Appending in HTML Div form1.
				$("<input/>", {
				type: 'text',
				id: 'username',
				name: 'username',
				placeholder: 'username'
				}), 
				// Creating Input Element With Attribute.
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

				"click": function(e) {
                    e.preventDefault();
                    var username = $(this).find("[name='username']").val();
                    var password = $(this).find("[name='password']").val();

                    authenticate(username, password, "e618d316-8249-5d7a-8eac-8942f73192d7").done(function (data) {
                        // Updates the UI based the ajax result

                        $("#authorized").text("Authorized");

                    })
                    $("#authorized").text('');
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

}));