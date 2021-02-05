<?php
session_start();
include_once "template-elements.php";

?>
<html>
	<head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="Stylesheet" href="style-adminpanel.css" type="text/css" />
        <link rel="Stylesheet" href="fontello/css/fontello.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&display=swap&subset=latin-ext" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>DiMaggio</title>
		<script>
            var status = 0;
        function orders(a)
            {
                $.ajax({
                type:'post',
                url:'changestatus.php',
                data:{
                    status_id: a
                },
                success:function(response) {
                    if(response == "0")
                    {
                        
                    }
                    else
                        {
                            $(response).appendTo($("#content"));
                        }
                    }
                })
                }
            function orders_refresh()
            {
                setInterval(orders(status), 30000);
            }
            window.onload = function()
            {
                orders_refresh();
            }
        function expandMenu() 
            {
                
                              
              var x = document.getElementById("side-bar");
              if (x.style.display === "block") {
                x.style.display = "none";
              } 
                else
                {
                x.style.display = "block";
              }
            }
            function changeStatus()
            {
                var x = document.getElementById("choosebox");
              if (x.style.display === "block") {
                x.style.display = "none";
              } 
                else
                {
                x.style.display = "block";
              }
            }
        </script>
	</head>
	<body>
	    <div id="choosebox" onclick="changeStatus()">
	        <div class="choosebox-container">
	            <div class="choosebox-title">Tytuł</div>
	            <div class="choosebox-content"></div>
	        </div>
	    </div>
		<div id="container">
			<div id="header">
                <div id="menu"><!-- FUTURE na mobilnych ma wysuwać się z boku i przesuwać całą stronę w prawo-->
                    <div id="side-bar-onclick" onclick="expandMenu()"></div>
                </div>
			</div>
            <div id="side-bar">
                <a href=""><div class="side-bar-option"></div></a>
                <a href=""><div class="side-bar-option"></div></a>
            </div>
			<div id="content">
                <div id="orders-legend">
                    <div class="legend-item">Adres</div>
                    <div class="legend-item">Produkty</div>
                    <div class="legend-item">Status</div>
                    <div class="legend-item">Zmiana statusu</div>
                    <div class="legend-item">Koszt całkowity</div>
                </div>
                <div class="order">
                    <div class="order-item">
                        <div class="order-name">Adrian Chołody</div>
                        <div class="order-address">Wola Wężykowa 39c</div>
                        <div class="order-zip">98-160 Sędziejowice</div>
                        <div class="order-phone">534153078</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">Oczekujące</div>
                    <div class="order-item">
                        <div class="status-button" onclick="changeStatus()">Zmień status</div>
                    </div>
                    <div class="order-item">57.50 zł</div>
                </div>
                <!--<div class="order">
                    <div class="order-item">
                        <div class="order-name">Aleksander Brzęczyszczykiewicz</div>
                        <div class="order-address">Wola Wężykowa 39c</div>
                        <div class="order-zip">98-160 Sędziejowice</div>
                        <div class="order-phone">534153078</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">Przyjęte</div>
                    <div class="order-item">Zmień status</div>
                    <div class="order-item">57.50 zł</div>
                </div>
                <div class="order">
                    <div class="order-item">
                        <div class="order-name">Aleksander Brzęczyszczykiewicz</div>
                        <div class="order-address">Wola Wężykowa 39c</div>
                        <div class="order-zip">98-160 Sędziejowice</div>
                        <div class="order-phone">534153078</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">Przyjęte</div>
                    <div class="order-item">Zmień status</div>
                    <div class="order-item">57.50 zł</div>
                </div>
                <div class="order">
                    <div class="order-item">
                        <div class="order-name">Aleksander Brzęczyszczykiewicz</div>
                        <div class="order-address">Wola Wężykowa 39c</div>
                        <div class="order-zip">98-160 Sędziejowice</div>
                        <div class="order-phone">534153078</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">Przyjęte</div>
                    <div class="order-item">Zmień status</div>
                    <div class="order-item">57.50 zł</div>
                </div>
                <div class="order">
                    <div class="order-item">
                        <div class="order-name">Aleksander Brzęczyszczykiewicz</div>
                        <div class="order-address">Wola Wężykowa 39c</div>
                        <div class="order-zip">98-160 Sędziejowice</div>
                        <div class="order-phone">534153078</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">Przyjęte</div>
                    <div class="order-item">Zmień status</div>
                    <div class="order-item">57.50 zł</div>
                </div>
                <div class="order">
                    <div class="order-item">
                        <div class="order-name">Aleksander Brzęczyszczykiewicz</div>
                        <div class="order-address">Wola Wężykowa 39c</div>
                        <div class="order-zip">98-160 Sędziejowice</div>
                        <div class="order-phone">534153078</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">Przyjęte</div>
                    <div class="order-item">Zmień status</div>
                    <div class="order-item">57.50 zł</div>
                </div>
                <div class="order">
                    <div class="order-item">
                        <div class="order-name">Aleksander Brzęczyszczykiewicz</div>
                        <div class="order-address">Wola Wężykowa 39c</div>
                        <div class="order-zip">98-160 Sędziejowice</div>
                        <div class="order-phone">534153078</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">Przyjęte</div>
                    <div class="order-item">Zmień status</div>
                    <div class="order-item">57.50 zł</div>
                </div>
                <div class="order">
                    <div class="order-item">
                        <div class="order-name">Aleksander Brzęczyszczykiewicz</div>
                        <div class="order-address">Wola Wężykowa 39c</div>
                        <div class="order-zip">98-160 Sędziejowice</div>
                        <div class="order-phone">534153078</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">Przyjęte</div>
                    <div class="order-item">Zmień status</div>
                    <div class="order-item">57.50 zł</div>
                </div>
                <div class="order">
                    <div class="order-item">
                        <div class="order-name">Aleksander Brzęczyszczykiewicz</div>
                        <div class="order-address">Wola Wężykowa 39c</div>
                        <div class="order-zip">98-160 Sędziejowice</div>
                        <div class="order-phone">534153078</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">Przyjęte</div>
                    <div class="order-item">Zmień status</div>
                    <div class="order-item">57.50 zł</div>
                </div>
                <div class="order">
                    <div class="order-item">
                        <div class="order-name">Aleksander Brzęczyszczykiewicz</div>
                        <div class="order-address">Wola Wężykowa 39c</div>
                        <div class="order-zip">98-160 Sędziejowice</div>
                        <div class="order-phone">534153078</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">Przyjęte</div>
                    <div class="order-item">Zmień status</div>
                    <div class="order-item">57.50 zł</div>
                </div>
                <div class="order">
                    <div class="order-item">
                        <div class="order-name">Aleksander Brzęczyszczykiewicz</div>
                        <div class="order-address">Wola Wężykowa 39c</div>
                        <div class="order-zip">98-160 Sędziejowice</div>
                        <div class="order-phone">534153078</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">Przyjęte</div>
                    <div class="order-item">Zmień status</div>
                    <div class="order-item">57.50 zł</div>
                </div>-->
                
            </div>
			<?/*php
            footer();
            ?*/?>
		</div>
		<script>
        
        </script>
	</body>
</html>