<?php
session_start();
include_once "template-elements.php";
?>
<!DOCTYPE html>
<?php
include_once "register.php";
?>
<html>
	<head>
		<?php
        head();
        ?>
		<link rel="Stylesheet" href="style-login.css" type="text/css" />
        <title>Zaloguj się / Zarejestruj się - DiMaggio</title>
        
        <script>
            
            function chooseRegister() {
                var y = document.getElementById("register-data");
                var x = document.getElementById("login-data");
                var z = document.getElementById("login-choose");
                var w = document.getElementById("register-choose");
                y.style = "display: block"
                x.style = "display: none;";
                w.style = "border-width: 0 0 1px 0; border-style: solid; border-color: white;";
                z.style = "border: none";
            }
            function chooseLogin() {
                var y = document.getElementById("register-data");
                var x = document.getElementById("login-data");
                var z = document.getElementById("login-choose");
                var w = document.getElementById("register-choose");
                x.style.display = "block";
                z.style = "border-width: 0 0 1px 0; border-style: solid; border-color: white;";
                w.style = "border: none";
                y.style.display = "none";
            }
        </script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div id="bar"></div>
				<div id="menu">
                    <a id="account-up" href="index.php"><img src="logo-big2.png" /></a>
					<ul id="links">
						<li><a href="pizza.php">Pizza</a></li>
                        <li><a href="lettuce.php">Sałatki</a></li>
						<li><a href="drink.php">Napoje</a></li>
						<li><a href="dinner.php">Dania</a></li>
						<li><a href="order.php">Zamów</a></li>
					</ul>
                    <div id="account"><div id="expand" onclick="expandMenu()"><i class="demo-icon icon-menu"></i></div></div>
                    
				</div>
			</div>
			<div id="content">
                <div id="login-container">
                    <div id="choose-method">
                        <div id="login-choose" class="choosed-method" onclick="chooseLogin()" <?php
                          if(isset($_POST['register-submit']))
                          {
                              echo 'style="border: none;"';
                              
                          }
                          ?>>Zaloguj się</div>
                        <div id="register-choose" class="choosed-method" onclick="chooseRegister()" <?php
                          if(isset($_POST['register-submit']))
                          {
                              echo 'style="border-width: 0 0 1px 0; border-style: solid; border-color: white;"';
                              
                          }
                          ?>>Zarejestruj się</div>
                    </div>
                    <form id="login-data" <?php
                          if(isset($_POST['register-submit']))
                          {
                              echo 'style="display: none;"';
                              
                          }
                          ?> method="post">
                        <div class="login-name">Login/e-mail</div>
                        <input type="text" name="login"/>
                        <div class="login-name">Hasło</div>
                        <input type="password" name="password"/>
                        <?php
                        if(isset($_SESSION['err-log-in']) && $_SESSION['err-log-in'] == true)
                        {
                            echo '<div id="error-log-in">Błędny login lub hasło</div>';
                            unset($_SESSION['err-log-in']);
                        }
                        
                        ?>
                        <input type="submit" value="Zaloguj się" name="login-submit"/>
                    </form>
                    <form id="register-data" <?php
                          if(isset($_POST['register-submit']))
                          {
                              echo 'style="display: block;"';
                              unset($_POST['register-submit']);
                          }
                          ?> method="post">
                        <div>Login</div>
                        <input type="text" name="login"/>
                        <?php
                            if(isset($_SESSION['err_login']))
                            {
                                echo '<div>'.$_SESSION['err_login'].'</div>';
                                unset($_SESSION['err_login']);
                            }
                        ?>
                        <div>Hasło</div>
                        <input type="password" name="password"/>
                        <?php
                            if(isset($_SESSION['err_password']))
                            {
                                echo '<div>'.$_SESSION['err_password'].'</div>';
                                unset($_SESSION['err_password']);
                            }
                        ?>
                        <div>Powtórz hasło</div>
                        <input type="password" name="repeat-password"/>
                        <?php
                            if(isset($_SESSION['err_password_repeat']))
                            {
                                echo '<div>'.$_SESSION['err_password_repeat'].'</div>';
                                unset($_SESSION['err_password_repeat']);
                            }
                        ?>
                        <div>E-mail</div>
                        <input type="email" name="email"/>
                        <?php
                            if(isset($_SESSION['err_email']))
                            {
                                echo '<div>'.$_SESSION['err_email'].'</div>';
                                unset($_SESSION['err_email']);
                            }
                        ?>
                        <input type="submit" name="register-submit" value="Zarejestruj się"/>
                    </form>
                </div>
            </div>
            <div>
            
            </div>
            
			<div id="footer">Wszelkie prawa zastrzeżone. All rights reserved.</div>
		</div>
	</body>
</html>