<?php
session_start();
include_once "template-elements.php";
include_once "connect.php";

?>
<?php
    if(isset($_SESSION['logged']))
    {
            
    }
    else
    {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
        head();
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="Stylesheet" href="style-order-detail.css" type="text/css" />
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
                                $orderr_id = $_GET['order_id'];
                                $sql = sprintf("SELECT * FROM orders WHERE id='$orderr_id'");
                                if($order = $connect->query($sql))
                                {
                                    $order = $order->fetch_assoc();
                                    if($order['user_id'] == $_SESSION['logged_id'])
                                    {
                                        
                                        $_SESSION['name'] = $order['name'];
                                        $_SESSION['address'] = $order['address'];
                                        $_SESSION['zip_code'] = $order['zip_code'];
                                        $_SESSION['city'] = $order['city'];
                                        $_SESSION['phone'] = $order['phone'];
                                        $_SESSION['sum_price'] = $order['sum_price'];
                                        $_SESSION['items_price'] = $order['items_price'];
                                        $_SESSION['promotion_price'] = $order['promotion_price'];
                                        for($i=0; $i<50; $i++)
                                        {
                                            $nr = $i + 1;
                                            $name = "item_id_".$nr;
                                            $order_id = $order[$name];
                                            if($order_id != 0)
                                            {
                                                $item_id = $order_id;
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

                                                            </div>
                                                            <div style="clear: both;"></div>
                                                        </div>
                                                    </div>';
                                                }
                                            }
                                            else
                                            {
                                                $i = 51;
                                            }
                                        }
                                    }
                                    else
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
                        ?>
                        
                    </div>
                    <div id="delivery">
                        <div class="order-title">Szczegóły zamówienia</div>
                        <div class="input-name">Imię i nazwisko</div>
                        <div class="output-data">
                        <?php
                            echo $_SESSION['name'];
                            unset($_SESSION['name']);
                        ?>
                        </div>
                        <div class="input-name">Adres</div>
                        <div class="output-data">
                        <?php
                            echo '<div>'.$_SESSION['address'].'</div>
                            <div>'.$_SESSION['zip_code'].' '.$_SESSION['city'].'</div>';
                                
                            unset($_SESSION['address']);
                            unset($_SESSION['zip_code']);
                            unset($_SESSION['citys']);
                        ?>
                            </div>
                        <div class="input-name">Numer telefonu</div>
                        <div class="output-data">
                        <?php
                            echo $_SESSION['phone'];
                            unset($_SESSION['phone']);
                        ?>
                        </div>
                        <div id="costs">
                            <div class="subcost">
                            <div>Koszt produktów:</div>
                                <div id="items-value">
                                <?php
                                    echo $_SESSION['items_price'];
                                    unset($_SESSION['items_price']);
                                ?>
                                </div>
                            </div>
                            <div class="subcost">
                            <div>Koszt produktów ze zniżkami:</div>
                                <div id="promotion-value">
                                <?php
                                    echo $_SESSION['promotion_price'];
                                    unset($_SESSION['promotion_price']);
                                ?>
                                </div>
                            </div>
                            <div class="subcost">
                            <div>Koszt dostawy:</div>
                                <div id="delivery-value">10.00 zł</div>
                            </div>
                            <div id="sum-cost">
                            <div>Łącznie:</div>
                            <div id="sum-value">
                                <?php
                                    echo $_SESSION['sum_price'];
                                    unset($_SESSION['sum_price']);
                                ?>
                            </div>
                            </div>
                        </div>
                        
                    </div>
                    
				</div>
                
            </div>
			<?php
            footer();
            ?>
		</div>
	</body>
</html>