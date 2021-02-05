<?php
session_start();
include_once "template-elements.php";
include_once "connect.php";

?>
<?php
    if(isset($_SESSION['logged']))
    {
        if(isset($_SESSION['logged']))
        {
            try
            {
                $connect = @new mysqli($db_host, $db_user, $db_password, $db_name);
                $connect->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
                if($connect->connect_errno!=0)
                {
                    throw new exception($connect->error);
                }
                else
                {
                    if(isset($_POST['address']) && isset($_POST['name']) && isset($_POST['zip-code']) && isset($_POST['city']) && isset($_POST['phone']))
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
                        if(!isset($_SESSION['basket_id']))
                        {
                            $error = true;
                            
                        }
                        if($error == false)
                        {
                            $user_name = htmlentities($_POST['name'], ENT_QUOTES, "UTF-8");
                            $user_address = htmlentities($_POST['address'], ENT_QUOTES, "UTF-8");
                            $user_zip = htmlentities($_POST['zip-code'], ENT_QUOTES, "UTF-8");
                            $user_city = htmlentities($_POST['city'], ENT_QUOTES, "UTF-8");
                            $user_phone = htmlentities($_POST['phone'], ENT_QUOTES, "UTF-8");
                            $sum_price = $_SESSION['sum_price'];
                            $items_price = $_SESSION['items_price'];
                            $promotion_price = $_SESSION['promotion_price'];
                            $order_status = "Oczekujące";
                            $user_id = $_SESSION['logged_id'];
                            
                            if($connect->query("INSERT INTO orders (id, user_id, name, date, address, zip_code, city, phone, sum_price, items_price, promotion_price, status) VALUES (NULL, '$user_id', '$user_name', now(), '$user_address', '$user_zip', '$user_city', '$user_phone', '$sum_price', '$items_price', '$promotion_price', '$order_status')"))
                            {
                                $last_id = $connect->insert_id;
                                for($i = 0; $i < count($_SESSION['basket_id']); $i++)
                                {
                                    $item_id = $_SESSION['basket_id'][$i];
                                    $nr = $i + 1;
                                    $name = "item_id_".$nr;
                                    $connect->query("UPDATE orders SET $name='$item_id' WHERE id='$last_id'");
                                }
                                unset($_SESSION['basket_id'], $_SESSION['sum_price'], $_SESSION['items_price'], $_SESSION['promotion_price']);
                                $_SESSION['order_success'];
                                header('Location: success.php');
                            }
                        }
                    }
                }
                $connect->close();
            }
            catch(exception $e)
            {
                $_SESSION['error'] = $e;
            }
        }
    }
    else
    {
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
        head();
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="Stylesheet" href="style-order.css" type="text/css" />
        <title>Złóż zamówienie - DiMaggio</title>
        <script>
        window.onload = function()
        {
            calc();
            calc1();
            calc2();
        }
        function remove_item_basket(item)
            {
                $.ajax({
                type:'post',
                url:'remove_item_basket.php',
                data:{
                    remove_item: item
                },
                success:function(response) {

                    window.location = "order.php";
                }
                });
            }
            function calc()
            {
                $.ajax({
                    type:'post',
                    url:'calc_submit.php',
                    data:{
                        calc: "calc"
                    },
                    success:function(response2) {
                      document.getElementById("sum-value").innerHTML = response2;

                    }
                    });

            }
            function calc1()
            {
                $.ajax({
                    type:'post',
                    url:'calc_submit1.php',
                    data:{
                        calc: "calc"
                    },
                    success:function(response3) {
                      document.getElementById("items-value").innerHTML = response3;

                    }
                    });

            }
            function calc2()
            {
                $.ajax({
                    type:'post',
                    url:'calc_submit2.php',
                    data:{
                        calc: "calc"
                    },
                    success:function(response4) {
                      document.getElementById("promotion-value").innerHTML = response4;

                    }
                    });

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
                <div id="order-container">
                    <?php
                    if(isset($_SESSION['error']))
                    {
                    echo $_SESSION['error'];
                    unset ($_SESSION['error']);
                    }
                    ?>
                    <div id="order-items">
                        <div class="order-title">Koszyk</div>
                        <?php
                        if(isset($_SESSION['basket_id']))
                        {
                            for($i=0; $i<count($_SESSION['basket_id']); $i++)
                            {
                                try
                                {
                                    $connect = @new mysqli($db_host, $db_user, $db_password, $db_name);
                                    $connect-> query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
                                    if($connect->connect_errno !=0)
                                    {
                                        throw new exception(mysqli_connect_errno());
                                    }
                                    else
                                    {
                                        $item_id = $_SESSION['basket_id'][$i];
                                        $sql = sprintf("SELECT * FROM products WHERE id='$item_id'");
                                        if($result = $connect->query($sql))
                                        {
                                            $result = $result->fetch_assoc();
                                            echo '<div class="order-item">
                                                <div class="order-item-photo"><img src="pizza-photos/'.$result['photo'].'"/></div>
                                                <div class="order-item-details">
                                                    <div class="order-item-name">'.$result['title'].'</div>
                                                    <div class="order-item-ingredients">'.$result['ingredients'].'</div>
                                                    <div class="order-item-down">
                                                        <div class="order-item-price">'.$result['price'].'zł</div>
                                                        <div class="order-item-delete">
                                                            <div class="order-item-delete-border"  onclick="remove_item_basket('.$i.')">Usuń</div>
                                                        </div>
                                                    </div>
                                                    <div style="clear: both;"></div>
                                                </div>
                                            </div>';
                                        }
                                    }
                                    $connect->close();
                                }
                                catch(exception $e)
                                {
                                    
                                }
                            }
                        }
                        else
                        {
                            echo '<div id="empty-basket">Twój koszyk jest pusty. Dodaj produkty do zamówienia i wróć tu później.</div>';
                        }
                        ?>
                        
                    </div>
                    <form id="delivery" method="post">
                        <div class="order-title">Szczegóły zamówienia</div>
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
                        <div id="post"><input type="text" name="zip-code" maxlength="6" <?php
                               if(isset($_SESSION['zip_code']))
                               {
                                   echo 'value="'.$_SESSION['zip_code'].'"';
                               }
                               ?>/><input type="text" name="city" <?php
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
                        <div class="subcost">
                        <div>Koszt produktów:</div>
                            <div id="items-value"></div>
                        </div>
                        <div class="subcost">
                        <div>Koszt produktów ze zniżkami:</div>
                            <div id="promotion-value"></div>
                        </div>
                        <div class="subcost">
                        <div>Koszt dostawy:</div>
                            <div id="delivery-value">10.00 zł</div>
                        </div>
                        <div id="sum-cost">
                        <div>Łącznie:</div>
                        <div id="sum-value"></div>
                        </div>
                        <input value="Zamów" type="submit" name="order_submit"/>
                    </form>
                    
				</div>
                
            </div>
			<?php
            footer();
            ?>
		</div>
	</body>
</html>