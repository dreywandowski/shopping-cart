<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REGISTER</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/style.css">

<script type="text/javascript" src="assets/js/jquery-3.2.1.js"></script>
<script type="text/javascript" src="assets/js/ajax.js"></script>
</head>
<body>
    <a href="index.php"><img class="d-inline-block me-3" src="assets/img/icons/logoo.png" alt="" /></a>
 <!--<a class="navbar-brand d-flex align-items-center fw-bold fs-2" href="index.php"><img class="d-inline-block me-3" src="assets/img/icons/house.png" alt="" /></a>-->
    <div class="main">
      

        <!-- Sign up form -->
        <section class="signup"  id="register" hidden >
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form register" >
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" action="config/Register.php"  enctype="multipart/form-data" method="POST"  name="reg" >
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="first_name"  required autocomplete="name" id="fname"autofocus placeholder="First Name"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="last_name" required autocomplete="name" id="lname" autofocus placeholder="Last Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>

                    <div class="form-group">
                        <label for="role"><i class="zmdi zmdi-lock"></i></label>&nbsp&nbsp&nbsp&nbsp
                        <select name="staff_type" id="acctType" required>
                            <option value="">Choose account type</option>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" class="user" name="username" placeholder="Preferred Username" required>
                    </div>
                     <span id="usercheck" ></span>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pwd1" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password1" id="pwd2" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group" hidden>
                             <input type="text" value="images/uploads/male-profile-picture.jpg" readonly name="file_path" >
                         </div>
                    <p></p>
                            <div class="form-group form-button">
                                <button class="form-submit" id="signup" name= "all" type="submit"> Sign Up</button>

                                <!--<input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>-->
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="assets/images/signup-image.jpg" alt="sing up image"></figure>
                       <p>Have an account already?</p> <button class="form-subt" id="log"> Login here</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sing in  Form -->
        <section class="sign-in" id="login">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="assets/images/signin-image.jpg" alt="sing up image"></figure>
                       <button class="form-group"  id="reg"> Create an account</button> 
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form method="POST" class="register-form" name="sign-in" id="login" action="" >
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" id="user" placeholder="Enter Username"  name="username" required autocomplete="username" autofocus value = "<?php if(isset($_COOKIE['user'])){echo $_COOKIE['user'];} else  {echo '';}  ?> " />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" id="passd" class="login-pwd" placeholder="Password"  name="password" required autocomplete="current-password" value = "<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} else  {echo '';}  ?>"/>
                            </div>
                             <span id="ajax"></span>

                            <div class="form-group">
                                <input type="checkbox" name="rem" checked id="check" value="check" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">

                    <button class="form-button"  type="submit" class="form" name="sub"> Login</button><br><br>

                                <!--<input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>-->
                                <a href="app/pwd_reset/forgot_pwd.php" target="_blank" > Forgot Password? </a>
                            </div>
                        </form>
                        <!--<div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script type="text/javascript" src="assets/js/index.js"></script>
    <!--<script src="vendor/jquery/jquery.min.js"></script>-->
    <script src="assets/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>