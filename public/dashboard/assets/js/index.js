// SECTION 1 TO CONTROL THE LOGIN/REGISTER BUTTONS




$("#log").hide();

// shows the register form
function toggle(){
var show = document.getElementById("register");
function shown() {
	show.style.display = "block";
	$("#reg").hide();
}
shown();



// hides the login form while displaying register
var hide = document.getElementById("login");
function hidden() {
	hide.style.display = 'none';
	$("#log").show();
}
hidden();
}

document.getElementById("reg").addEventListener("click", toggle, false);



// shows the login
function toggle1(){
var show = document.getElementById("login");
function shown() {
	show.style.display = "block";
}
shown();
$("#log").hide();

// hides the register form while displaying login
var hide = document.getElementById("register");
function hidden() {
	hide.style.display = 'none';
	$("#reg").show();
}
hidden();
}

document.getElementById("log").addEventListener("click", toggle1, false);

 

 
// check mail and name spelling
$("#email").blur(function () {
var mail = $(this).val();
var q = mail.includes(".");

if (q){
}
else{
alert("check your email spelling");
event.preventDefault();
}

var fname = $("#fname").val();
var lname = $("#lname").val();
var fullName = fname + lname;
var regex = /\d/g;

if (regex.test(fullName)){
	alert("Your name cannot have numbers, kindly check and try again");
	event.preventDefault();
}
	else{
		
	}
});






$("#pwd2").blur(function () {
	var pwd1= $("#pwd1").val();
	var pwd2 = $("#pwd2").val();
	console.log(pwd1);
	 console.log(pwd2);
	if (pwd1 == pwd2){
	}
	else {
		alert("Passwords do not match!!");
		event.preventDefault();
	}
	});

/**
// stores user credentials as cookies on the user computer

var log = document.getElementById("tester").addEventListener("click", aleert, false);

function aleert() {
	var user = document.getElementById("user").value;
var pwd = document.getElementById("passd")value;

alert("Details are: " user, pwd);
}



**/
