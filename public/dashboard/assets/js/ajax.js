
// this is used to load files from the server using AJAX
$(document).ready(function () {
	

	// user validation through AJAX
	$("#login").submit(function (event) {
		event.preventDefault();
		
			
		var username = $("#user").val();
		var password = $("#passd").val();
        var remember = $("#check:checked").val();
        var rem;

        if (typeof remember === 'undefined'){
        rem = "noCheck";
        }

        else{
        	rem = "check";
        }


		$.post("../ATTENDANCE/config/Login.php", {
			username: username,
			password: password,
            rem: rem, 
		}, function (data, status) {
			console.log(username, password, rem);
			var d = new Date();
			var exp = d.setTime(d.getTime() + (60 * 5));

			console.log(document.cookie = "username= " + " username ; expires = " + exp);


			$("#ajax").html(data);

		});
	});



		//var role = $('input[name=staff]:checked').val();

		/**				
		// live validation while user is registering
				$("#username").blur(function(event){
					var user = $(this).val();
					console.log(username);
				   $.get("redirect.php", {
						username : username
					}, function(data, status){
						$("#usercheck").html(data);
						console.log(username);
			   });    
			});**/
	});
