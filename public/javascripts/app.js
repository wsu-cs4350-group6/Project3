(function(group6) {

	group6(window.jQuery, window, document);

}(function($, window, document) {

	// Listen for the jQuery ready event on the document
	$(function() {

		// The DOM is ready!

		$("div#loginForm").append(
			// Creating Form Div and Adding <h2> and <p> Paragraph Tag in it.
			$("<h3/>").text("Sign In"),
			$("<form/>", {
				// action: 'index.html',
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

		var submit = $("#sumbit");
			submit.on({

				"click": function() {

					authenticate("david", "test", "e618d316-8249-5d7a-8eac-8942f73192d7").done(function(data) {
				    	// Updates the UI based the ajax result
				    	$("#authorized").text(data.name);

				}

		});		

    // 	authenticate("david", "test", "e618d316-8249-5d7a-8eac-8942f73192d7").done(function(data) {
 //    	// Updates the UI based the ajax result
 //    	$("#authorized").text(data.name);  

	});

	// The rest of the code goes here!
	function authenticate(username, password, accessKey) {
		var key = accessKey;
		var dynamicData = {};
		dynamicData["username"] = username;
		dynamicData["password"] = password;
		return $.ajax({
			url: "/authenticate",
			type: "post",
			headers: {
				"Authorization": key
			},
			data: dynamicData
		});
	}

}));