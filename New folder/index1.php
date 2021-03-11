<!DOCTYPE html>
<html>
<head>
	<title>Insert data in MySQL database using Ajax</title>
	<meta charset="utf-8">
	<meta charset=UTF-8>
	<meta name=viewport content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


     <link rel="stylesheet" href="main.css">
</head>

</head>
<body>

	<div class="reduce">
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<div class="mid">
	<button type="button" class="btn  btn-outline-light" id="register">Register</button> 
	<button type="button" class="btn btn-outline-light" id="login">Login</button>
	</div>
	<form id="register_form" name="form1" method="post" style="">
		<h1 class="text-center text-light">Register Form</h1>
		<div class="form-group">
			<label for="email">Name:</label>
			<input type="text" class="form-control" id="name" placeholder="Name" name="name">
		</div>
		<div class="form-group">
			<label for="pwd">Email:</label>
			<input type="email" class="form-control" id="email" placeholder="Email" name="email">
		</div>
		<div class="form-group">
			<label for="pwd">Phone:</label>
			<input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
		</div>
		<div class="form-group" >
			<label for="pwd">City:</label>
			<select name="city" id="city" class="form-control">
				<option value="">Select</option>
				<option value="Delhi">Delhi</option>
				<option value="Mumbai">Mumbai</option>
				<option value="Pune">Pune</option>
				<option value="Karnataka">Karnataka</option>
				<option value="Kerala">Kerala</option>
				<option value="Hyderbad">Hyderbad</option>
				<option value="Andrapradesh">Andrapradesh</option>
				<option value="Gujarat">Gujarat</option>
				<option value="Madyapradesh">Madyapradesh</option>
				<option value="Chennai">Chennai</option>
				<option value="Ahemadabad">Ahemadabad</option>
				<option value="Kolkata">Kolkata</option>
				<option value="Indore">Indore</option>
				<option value="Tamilnadu">Tamilnadu</option>
			</select>
		</div>
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" id="password" placeholder="Password" name="password">
		</div>
		<input type="button" name="save" class="btn btn-primary btn-block" value="Register" id="butsave">
	</form>

	<form id="login_form" name="form1" method="post" style="display:none;">
		<h1 class="text-center text-light">Login Form</h1>
		
		<div class="form-group">
			<label for="pwd">Email:</label>
			<input type="email" class="form-control" id="email_log" placeholder="Email" name="email">
		</div>
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" id="password_log" placeholder="Password" name="password">
		</div>
		<input type="button" name="save" class="btn btn-primary btn-block" value="Login" id="butlogin">
	</form>
	</div>
</div>

<script>
$(document).ready(function() {
	$('#login').on('click', function() {
		$("#login_form").show();
		$("#register_form").hide();
	});
	$('#register').on('click', function() {
		$("#register_form").show();
		$("#login_form").hide();
	});
	$('#butsave').on('click', function() {
		$("#butsave").attr("disabled", "disabled");
		var name = $('#name').val();
		var email = $('#email').val();
		var phone = $('#phone').val();
		var city = $('#city').val();
		var password = $('#password').val();
		if(name!="" && email!="" && phone!="" && password!="" ){
			$.ajax({
				url: "save.php",
				type: "POST",
				data: {
					type: 1,
					name: name,
					email: email,
					phone: phone,
					city: city,
					password: password						
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#butsave").removeAttr("disabled");
						$('#register_form').find('input:text').val('');
						$("#success").show();
						$('#success').html('Registration successful !'); 						
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html('Email ID already exists !');
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
	$('#butlogin').on('click', function() {
		var email = $('#email_log').val();
		var password = $('#password_log').val();
		if(email!="" && password!="" ){
			$.ajax({
				url: "save.php",
				type: "POST",
				data: {
					type:2,
					email: email,
					password: password						
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						location.href = "welcome.php";						
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html('Invalid EmailId or Password !');
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});
</script>
</body>
</html>