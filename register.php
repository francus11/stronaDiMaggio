<?php
if(isset($_SESSION['logged']))
{
    header('Location: index.php');
}
else
{
    if(isset($_POST['login-submit'])) /* login part */
    {
        if(isset($_POST['login']) || isset($_POST['password']))
        {
            require_once "connect.php";
            try
            {
                $connect = @new mysqli($db_host, $db_user, $db_password, $db_name);
                $connect->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci");
                if($connect->connect_errno != 0)
                {
                    throw new exception(mysqli_connect_errno());
                }
                else
                {
                    $login = $_POST['login'];
                    $password = $_POST['password'];
                    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
                    $password = htmlentities($password, ENT_QUOTES, "UTF-8");
                    #check if login exists
                    $sql = sprintf("SELECT * FROM users WHERE login='%s'", mysqli_real_escape_string($connect, $login));
                    $connect->query('SET NAMES utf8');
                    if($result = $connect->query($sql))
                    {
                        if($result->num_rows == 1)
                        {
                            $row = $result->fetch_assoc();
                            if(password_verify($password, $row['password']))
                            {
                                $_SESSION['logged_id'] = $row['id'];
                                $_SESSION['logged_login'] = $row['login'];
                                $_SESSION['logged'] = true;
                                $name = strlen($row['name']);
                                $address = strlen($row['address']);
                                $zip_code = strlen($row['zip_code']);
                                $city = strlen($row['city']);
                                $phone = strlen($row['phone']);
                                if($name =! 0)
                                {
                                    $_SESSION['name'] = $row['name'];
                                }
                                if($address =! 0)
                                {
                                    $_SESSION['address'] = $row['address'];
                                }
                                if($zip_code =! 0)
                                {
                                    $_SESSION['zip_code'] = $row['zip_code'];
                                }
                                if($city =! 0)
                                {
                                    $_SESSION['city'] = $row['city'];
                                }
                                if($phone =! 0)
                                {
                                    $_SESSION['phone'] = $row['phone'];
                                }
                                header('Location: index.php');
                            }
                            else
                            {
                                $_SESSION['err-log-in'] = true;
                            }
                        }
                        else
                        {
                            #check if email exists
                            $sql = sprintf("SELECT * FROM users WHERE email='%s'", mysqli_real_escape_string($connect, $login));
                            $connect->query('SET NAMES utf8');
                            if($result = $connect->query($sql))
                            {
                                if($result->num_rows == 1)
                                {
                                    $row = $result->fetch_assoc();
                                    if(password_verify($password, $row['password']))
                                    {
                                        $_SESSION['logged'] = true;
                                        $_SESSION['logged_login'] = $row['login'];
                                        $_SESSION['logged_id'] = $row['id'];
                                        $name = strlen($row['name']);
                                        $address = strlen($row['address']);
                                        $zip_code = strlen($row['zip_code']);
                                        $city = strlen($row['city']);
                                        $phone = strlen($row['phone']);
                                        if($name =! 0)
                                        {
                                            $_SESSION['name'] = $row['name'];
                                        }
                                        if($address =! 0)
                                        {
                                            $_SESSION['address'] = $row['address'];
                                        }
                                        if($zip_code =! 0)
                                        {
                                            $_SESSION['zip_code'] = $row['zip_code'];
                                        }
                                        if($city =! 0)
                                        {
                                            $_SESSION['city'] = $row['city'];
                                        }
                                        if($phone =! 0)
                                        {
                                            $_SESSION['phone'] = $row['phone'];
                                        }
                                        header('Location: index.php');
                                        
                                        
                                    }
                                    else
                                    {
                                        $_SESSION['err-log-in'] = true;
                                    }
                                }
                                else
                                {
                                    $_SESSION['err-log-in'] = true;
                                }
                            }
                        }
                    }
                    $connect->close();
                }
            }
            catch(exception $e)
            {

            }
        }
        unset($_POST['login-submit']);
    }
    else if(isset($_POST['register-submit'])) /* register part */
    {
        
        
        $error = false;
        
        $login = $_POST['login'];
        $password = $_POST['password'];
        $repeatpassword = $_POST['repeat-password'];
        $email = $_POST['email'];
        
        if(ctype_alnum($login) == false)
        {
            $error = true;
            $_SESSION['err_login'] = "Login może zawierać tylko litery i cyfry";
        }
        if(strlen($login) < 3 || strlen($login) > 20)
        {
            $error = true;
            $_SESSION['err_login'] = "Login musi mieć od 3 do 20 znaków";
        }
        $email_sanitize = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(filter_var($email_sanitize, FILTER_VALIDATE_EMAIL) == false || $email != $email_sanitize)
        {
            $error = true;
            $_SESSION['err_email'] = "Nieprawidłowy adres e-mail";
        }
        if($password != $repeatpassword)
        {
            $error = true;
            $_SESSION['err_password_repeat'] = "Hasła nie są takie same";
        }
        if(strlen($password) < 8 || strlen($password) > 30)
        {
            $error = true;
            $_SESSION['err_password'] = "Hasło musi mieć od 8 do 30 znaków";
        }
        
        try
        {
            require_once "connect.php";
            $connect = new mysqli($db_host, $db_user, $db_password, $db_name);
            
            if($connect->connect_errno != 0)
            {
                throw new exception($connect->error);
            }
            else
            {
                $sql = "SELECT * FROM users WHERE login='$login'";
                $result = $connect->query($sql);
                
                if(!$result)
                {
                    throw new exception($connect->error);
                }
                $many_login = $result->num_rows;
                if($many_login != 0)
                {
                    $error = true;
                    $_SESSION['err_login'] = "Ten login jest już zajęty";
                }
                $sql = "SELECT * FROM users WHERE email='$email'";
                $result = $connect->query($sql);
                if(!$result)
                {
                    throw new exception($connect->error);
                }
                $many_email = $result->num_rows;
                if($many_email != 0)
                {
                    $error = true;
                    $_SESSION['err_email'] = "Ten e-mail jest już zajęty";
                }
                
                if($error == false)
                {
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    
                    $_SESSION['log'] = "Działa";

                    if($connect->query("INSERT INTO users(id, login, email, password) VALUES(NULL, '$login', '$email', '$password_hash')"))
                        
                    {
                        header('Location: index.php');
                        
                    }
                    
                }
                
            }
            $connect->close();
        }
        catch(exception $e)
        {
            
        }
    }
}
?>