<?php
session_start();
include_once "template-elements.php";
?>
<?php

function item($title)
{
    include "connect.php";
    try
    {
        $connect = @new mysqli($db_host, $db_user, $db_password, $db_name);
        $connect->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
        if($connect->connect_errno != 0)
        {
            throw new exception(mysqli_connect_errno());
        }
        else
        {
            $sql = sprintf("SELECT * FROM products WHERE title='$title'");
            if($result = $connect->query($sql))
            {
                $result = $result->fetch_assoc();
                echo '
                <div class="item-container">
                    <div class="item-border-line">
                        <div class="item-photo">
                            <img src="pizza-photos/'.$result['photo'].'" />
                        </div>
                        <div class="item-content">
                            <div class="item-title">'.$result['title'].'</div>
                            <div class="item-ingredients">'.$result['ingredients'].'</div>
                            <div class="item-down">
                                <div class="item-price">'.$result['price'].'zł</div>
                                <div class="item-order-button">
                                    <div class="item-order-button-border">
                                        <div class="item-order-button-name" onclick="add_to_basket('.$result['id'].')">Zamów</div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

?>
<!DOCTYPE html>
<html>
	<head>
		<?php
        head();
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="Stylesheet" href="style-pizza.css" type="text/css" />
        <title>Pizza - DiMaggio</title>
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
                <?php
                    item("Margherita");
                    item("Capriciosa");
                    item("Parma");
                    item("Cambione");
                    item("Decoro");
                    item("Pepe Roso");
                    item("Napoletana");
                    item("Piacere");
                    item("Roma");
                    item("Polska");
                ?>
            </div>
			<?php
            footer();
            ?>
            <script>
            function add_to_basket(id)
            {

                var numbb = 1;
                $.ajax({
                type:'post',
                url:'add_to_basket.php',
                data:{
                    item_id: id
                    
                },
                success:function(response) {
                    if(response == "0")
                    {
                        window.location = "order.php";
                    }


                }
                });
            }
            </script>
		</div>
	</body>
</html>