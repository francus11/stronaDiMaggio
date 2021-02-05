<?php
session_start();
include_once "template-elements.php";
if(!isset($_SESSION['logged']))
{
    header('Location: index.php');
}
else
{
    try
    {
        include "connect.php";
        $connect = @new mysqli($db_host, $db_user, $db_password, $db_name);
        $connect-> query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
        if($connect->connect_errno!=0)
        {
            throw new exception($connect->error);
        }
        else
        {
            if(isset($_POST['address']) && isset($_POST['name']) && isset($_POST['zip-code']) && isset($_POST['city']) && isset($_POST['phone']) && isset($_POST['delivery-data']))
            {
                $error = false;
                if(strlen($_POST['address']) == 0)
                {
                    $error = true;
                    $_SESSION['err_address'] = "Podaj swój adres";
                }
                if(strlen($_POST['name']) == 0)
                {
                    $error = true;
                    $_SESSION['err_name'] = "Podaj swoje imię i nazwisko";
                }
                if(strlen($_POST['zip-code']) != 6)
                {
                    $error = true;
                    $_SESSION['err_zip_code'] = "Błędny kod pocztowy";
                }
                if(strlen($_POST['city']) == 0)
                {
                    $error = true;
                    $_SESSION['err_city'] = "Podaj miejscowość";
                }
                if(strlen($_POST['phone']) != 9)
                {
                    $error = true;
                    $_SESSION['err_phone'] = "Błędny numer telefonu";
                }

                if($error == false)
                {
                    $user_name = htmlentities($_POST['name'], ENT_QUOTES, "UTF-8");
                    $user_address = htmlentities($_POST['address'], ENT_QUOTES, "UTF-8");
                    $user_zip = htmlentities($_POST['zip-code'], ENT_QUOTES, "UTF-8");
                    $user_city = htmlentities($_POST['city'], ENT_QUOTES, "UTF-8");
                    $user_phone = htmlentities($_POST['phone'], ENT_QUOTES, "UTF-8");
                    $user_id = $_SESSION['logged_id'];
                    $_SESSION['error'] = "error1";
                    if($connect->query("UPDATE users SET name='$user_name', address='$user_address', zip_code='$user_zip', city='$user_city', phone='$user_phone' WHERE id='$user_id'"))
                    {
                        $_SESSION['error'] = "error";
                        $_SESSION['name'] = $user_name;
                        $_SESSION['address'] = $user_address;
                        $_SESSION['zip_code'] = $user_zip;
                        $_SESSION['city'] = $user_city;
                        $_SESSION['phone'] = $user_phone;
                        header('Location: account.php');

                    }

                }
            }
            if(isset($_POST['old_password'], $_POST['new_password'], $_POST['repeat_password'], $_POST['password-submit']))
            {
                $user_id = $_SESSION['logged_id'];
                $sql = sprintf("SELECT password FROM users WHERE id='$user_id'");
                if($result = $connect->query($sql))
                {
                    $result = $result->fetch_assoc();
                    $error = false;
                    $old_password = $_POST['old_password'];
                    $new_password = $_POST['new_password'];
                    $repeat_password = $_POST['repeat_password'];
                    $old_password_base = $result['password'];
                    if(!password_verify($old_password, $result['password']))
                    {
                        $error = true;
                        $_SESSION['err_password'] = "Nieprawidłowe hasło";
                    }
                    if($new_password != $repeat_password)
                    {
                        $error = true;
                        $_SESSION['err_repeat_password'] = "Hasła nie są takie same";
                    }
                    if(strlen($new_password) < 8 || strlen($new_password) > 30)
                    {
                        $error = true;
                        $_SESSION['err_new_password'] = "Hasło musi mieć od 8 do 30 znaków";
                    }
                    if($error == false)
                    {
                        $new_password = htmlentities($new_password, ENT_QUOTES, "UTF-8");
                        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                        if($connect->query("UPDATE users SET password='$new_password' WHERE id='$user_id'"))
                        {
                            header('Location: account.php');
                        }
                    }
                }
            }
            if(isset($_POST['old_email'], $_POST['new_email'], $_POST['email-submit']))
            {
                $user_id = $_SESSION['logged_id'];
                $sql = sprintf("SELECT email FROM users WHERE id='$user_id'");
                if($result = $connect->query($sql))
                {
                    $result = $result->fetch_assoc();
                    $error = false;
                    $old_email = $_POST['old_email'];
                    $new_email = $_POST['new_email'];
                    $old_email_base = $result['email'];
                    if($old_email != $old_email_base)
                    {
                        $error = true;
                        $_SESSION['err_old_email'] = "Nieprawidłowy adres e-mail";
                        
                    }
                    $email_sanitize = filter_var($new_email, FILTER_SANITIZE_EMAIL);
                    if(filter_var($email_sanitize, FILTER_VALIDATE_EMAIL) == false || $new_email != $email_sanitize)
                    {
                        $error = true;
                        $_SESSION['err_new_email'] = "Nieprawidłowy adres e-mail";
                    }
                    
                    
                    $sql = sprintf("SELECT * FROM users WHERE email='$new_email'");
                    if($result = $connect->query($sql))
                    {
                        $result = $result->num_rows;
                        if($result != 0)
                        {
                            $error = true;
                            $_SESSION['err_new_email'] = "Ten e-mail jest już zajęty";
                        }
                    }
                    if($error == false)
                    {
                        if($connect->query("UPDATE users SET email='$new_email' WHERE id='$user_id'"))
                        {
                            header('Location: account.php');
                        }
                    }
                }
            }
        }
        $connect->close();
    }
    catch(exception $e)
    {

    }
}
?>
<?php

?>
<html>
	<head>
		<?php
        head();
        ?>
        <link rel="Stylesheet" href="style-account.css" type="text/css" />
        <title>Twoje konto - DiMaggio</title>
        <script>
            function chooseAddress() {
                var y = document.getElementById("account-address");
                var x = document.getElementById("account-orders");
                var z = document.getElementById("address-choose");
                var w = document.getElementById("order-choose");
                y.style = "display: block"
                x.style = "display: none;";
                z.style = "border-width: 0 0 1px 0; border-style: solid; border-color: white;";
                w.style = "border: none";
            }
            function chooseOrder() {
                var x = document.getElementById("account-address");
                var y = document.getElementById("account-orders");
                var w = document.getElementById("address-choose");
                var z = document.getElementById("order-choose");
                y.style.display = "block";
                z.style = "border-width: 0 0 1px 0; border-style: solid; border-color: white;";
                w.style = "border: none";
                x.style.display = "none";
            }
        </script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div id="bar"></div>
				<?php
                menu();
                ?>
			</div>
			<div id="content">
                <div id="account-container">
                    <div id="profile">
                        <div id="profile-photo"><img src="user-icon1.png" /></div>
                        <div id="profile-right">
                            <div id="user-name"><?php echo $_SESSION['logged_login']; ?></div>
                            <a id="logout" href="logout.php">Wyloguj się</a>
                        </div>
                        
                    </div>
                    
                    <div id="account-menu">
                        <div class="account-menu-option" id="address-choose" onclick="chooseAddress()">Twoje dane</div>
                        <div class="account-menu-option" id="order-choose" onclick="chooseOrder()">Zamówienia</div>
                    </div>
                    <div id="account-content">
                        
                        <div id="account-address" class="account-content">
                            <div class="account-title">Twoje dane</div>
                            <form id="delivery-data" method="post">
                                <div class="input-name">Imię i nazwisko</div>
                        <input type="text" name="name" <?php
                               if(isset($_SESSION['name']))
                               {
                                   echo 'value="'.$_SESSION['name'].'"';
                               }
                               ?>/>
                        <?php
                            if(isset($_SESSION['err_name']))
                            {
                                echo '<div class="error-input">'.$_SESSION['err_name'].'</div>';
                                unset($_SESSION['err_name']);
                            }
                        ?>
                        <div class="input-name">Adres</div>
                        <input type="text" name="address" <?php
                               if(isset($_SESSION['address']))
                               {
                                   echo 'value="'.$_SESSION['address'].'"';
                               }
                               ?>/>
                        <?php
                            if(isset($_SESSION['err_address']))
                            {
                                echo '<div class="error-input">'.$_SESSION['err_address'].'</div>';
                                unset($_SESSION['err_address']);
                            }
                        ?>
                        <div class="input-name">Kod pocztowy</div>
                        <div id="post"><input type="text" name="zip-code" maxlength="6" class="post-code" <?php
                               if(isset($_SESSION['zip_code']))
                               {
                                   echo 'value="'.$_SESSION['zip_code'].'"';
                               }
                               ?>/><input type="text" name="city"  class="post-code" <?php
                               if(isset($_SESSION['city']))
                               {
                                   echo 'value="'.$_SESSION['city'].'"';
                               }
                               ?>/></div>
                        <?php 
                        if(isset($_SESSION['err_zip_code']) || isset($_SESSION['err_city']))
                        {
                            if(isset($_SESSION['err_city']))
                            {
                            $alert = $_SESSION['err_city'];
                            }
                            else
                            {
                            $alert = $_SESSION['err_zip_code'];
                            }
                            echo '<div class="error-input">'.$alert.'</div>';
                            unset($_SESSION['err_city']);
                            unset($_SESSION['err_zip_code']);
                        }
                        ?> 
                        <div class="input-name">Numer telefonu</div>
                        <input type="text" name="phone" <?php
                               if(isset($_SESSION['phone']))
                               {
                                   echo 'value="'.$_SESSION['phone'].'"';
                               }
                               ?>/>
                        <?php
                            if(isset($_SESSION['err_phone']))
                            {
                                echo '<div class="error-input">'.$_SESSION['err_phone'].'</div>';
                                unset($_SESSION['err_phone']);
                            }
                        ?>
                                <input type="submit" name="delivery-data" value="Zmień dane"/>
                                
                            </form>
                            <div class="account-title">Zmiana hasła</div>
                            <form method="post">
                                <div>Stare hasło</div>
                                <input type="password" name="old_password"/>
                                <?php
                                    if(isset($_SESSION['err_password']))
                                    {
                                        echo '<div class="error-input">'.$_SESSION['err_password'].'</div>';
                                        unset($_SESSION['err_password']);
                                    }
                                ?>
                                <div>Nowe hasło</div>
                                <input type="password" name="new_password"/>
                                <?php
                                    if(isset($_SESSION['err_new_password']))
                                    {
                                        echo '<div class="error-input">'.$_SESSION['err_new_password'].'</div>';
                                        unset($_SESSION['err_new_password']);
                                    }
                                ?>
                                <div>Powtórz hasło</div>
                                <input type="password" name="repeat_password"/>
                                <?php
                                    if(isset($_SESSION['err_repeat_password']))
                                    {
                                        echo '<div class="error-input">'.$_SESSION['err_repeat_password'].'</div>';
                                        unset($_SESSION['err_repeat_password']);
                                    }
                                ?>
                                <input type="submit" value="Zmień hasło" name="password-submit"/>
                            </form>
                            <div class="account-title">Zmiana e-maila</div>
                            <form method="post">
                                <div>Stary e-mail</div>
                                <input type="email" name="old_email"/>
                                <?php
                                    if(isset($_SESSION['err_old_email']))
                                    {
                                        echo '<div class="error-input">'.$_SESSION['err_old_email'].'</div>';
                                        unset($_SESSION['err_old_email']);
                                    }
                                ?>
                                <div>Nowy e-mail</div>
                                <input type="email" name="new_email"/>
                                <?php
                                    if(isset($_SESSION['err_new_email']))
                                    {
                                        echo '<div class="error-input">'.$_SESSION['err_new_email'].'</div>';
                                        unset($_SESSION['err_new_email']);
                                    }
                                ?>
                                <input type="submit" value="Zmień e-mail" name="email-submit"/>
                            </form>
                        </div>
                    </div>
                    <div id="account-orders" class="account-content">
                        <div id="order-legend">
                            <div id="order-number">Nr. zamówienia</div>
                            <div id="order-date">Data</div>
                            <div id="order-status">Status</div>
                            <div id="order-price">Cena</div>
                        </div>
                        
                        <?php
                        include_once "connect.php";
                        try
                        {
                            $connect = new mysqli($db_host, $db_user, $db_password, $db_name);
                            $connect-> query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
                            if($connect->connect_errno !=0)
                            {
                                throw new exception(mysqli_connect_errno());
                            }
                            else
                            {
                                $user_id = $_SESSION['logged_id'];
                                $sql = sprintf("SELECT * FROM orders WHERE user_id='$user_id'");
                                if($result = $connect->query($sql));
                                {   
                                    foreach($result as $item)
                                    {
                                        $date = strtotime($item['date']);
                                        $date = date('d-m-Y H:i', $date);
                                        echo '<a class="order-object" href="order-detail.php?order_id='.$item['id'].'">
                                                <div class="order-number">'.$item['id'].'</div>
                                                <div class="order-date">'.$date.'</div>
                                                <div class="order-status">'.$item['status'].'</div>
                                                <div class="order-price">'.$item['sum_price'].'zł</div>
                                            </a>';
                                    }
                                    
                                }
                            }
                        }
                        catch(exception $e)
                        {
                            
                        }
                        ?>
                    </div>
                </div>
            </div>
			<?php
            footer();
            ?>
		</div>
	</body>
</html>