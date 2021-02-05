<?php
session_start();
include_once "template-elements.php";
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
                echo '<div class="recommended-item">
                            <div class="recommended-item-photo">
                                <img src="pizza-photos/'.$result['photo'].'" />
                            </div>
                            <div class="recommended-item-title">'.$result['title'].'</div>
                            <div class="recommended-item-ingredients">'.$result['ingredients'].'</div>
                            <div class="item-order-button">
                                <div class="item-order-button-border">
                                    <div class="item-order-button-name" onclick="add_to_basket('.$result['id'].')">Zamów</div>
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
<html>
	<head>
		<?php
        head();
        ?>
        <link rel="Stylesheet" href="style-index.css" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>DiMaggio</title>
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
                <div id="title-background">
                    
                    <div>Pizzeria DiMaggio</div>
                    <div>Najlepsze placki w Polsce</div>
                </div>
                <div id="index-info">
                    <div id="info-open">
                        <div class="info-title">Godziny otwarcia</div>
                        <div class="info-content">
                            <div>
                                <div>Poniedziałek - Piątek: </div>
                                <div>12:00 - 22:00</div>
                            </div>
                            <div>
                                <div>Sobota: </div>
                                <div>11:00 - 23:30</div>
                            </div>
                            <div>
                                <div>Niedziela: </div>
                                <div>11:30 - 21:00</div>
                            </div>
                            
                        </div>
                    </div>
                    <div id="info-phone">
                        <div class="info-title">Numer telefonu</div>
                        <div class="info-content">
                            <div>
                                (43) 675 80 34
                            </div>
                            <div>
                                534 156 096
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div id="recommended">
                    <div id="recommended-title">Polecane dania</div>
                    <div id="recommended-items">
                        
                        <?php
                        item("Polska");
                        item("Capriciosa");
                        item("Lasagne Bolognese");
                        ?>
                        
                    </div>
                </div>
                <div id="about-us">
                    <div id="about-us-text">Nasza restauracja używa do potraw tylko najwyższej jakości produktów, dzięki czemu nasze dania mają przepyszny smak. W połączeniu z przytulną atmosferą naszego lokalu tworzy to idealne miejsce na rodzinne spotkania.</div>
                </div>
            </div>
			<?php
            footer();
            ?>
		</div>
	</body>
</html>