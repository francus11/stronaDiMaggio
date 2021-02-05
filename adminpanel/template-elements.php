<?php
function menu()
{
    echo '<div id="menu">
                    <a id="account-up" href="index.php"><img src="logo-big2.png" /></a>
					<ul id="links">
						<li><a href="pizza.php">Pizza</a></li>
                        <li><a href="lettuce.php">Sałatki</a></li>
						<li><a href="drink.php">Napoje</a></li>
						<li><a href="dinner.php">Dania</a></li>
						<li><a href="order.php">Zamów</a></li>
					</ul>';
                    
                    if(isset($_SESSION['logged']))
                    {
                        echo '<div id="right-menu"><a href="account.php" id="account">
                        <img src="user-icon1.png" />
                    </a>
                    <div id="expand" onclick="expandMenu()"><i class="demo-icon icon-menu"></i></div>
                    </div>';
                    }
                    else
                    {
                        echo '<div id="right-menu"><a href="login.php" id="account">
                        <img src="user-icon.png" />
                    </a>
                    <div id="expand" onclick="expandMenu()"><i class="demo-icon icon-menu"></i></div>
                    </div>';
                    }
                    
                    
                    echo '
				</div>';
}
function footer()
{
    echo '<div id="footer">&copyDiMaggio 2019. Wszelkie prawa zastrzeżone. All rights reserved.</div>';
}
function head()
{
    echo '<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="Stylesheet" href="style.css" type="text/css" />
        <link rel="Stylesheet" href="fontello/css/fontello.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&display=swap&subset=latin-ext" rel="stylesheet">
        <script type="text/javascript" src="menu.js"></script>';
}
?>