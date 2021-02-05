<?php
session_start();
include_once "template-elements.php";
?>
<html>
	<head>
		<?php
        head();
        ?>
        <link rel="Stylesheet" href="style-success.css" type="text/css" />
        <title>Podsumowanie - DiMaggio</title>
		<script>
		var photos = Array()
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
                <div id="success-container">
                    <div id="success-title">Złożono zamówienie</div>
                    <div id="success-text">Twoje zamówienie czeka teraz na potwierdzenie realizacji. Dalsze statusy zamówienia będą wyświetlane w twoim profilu w zakładce Zamówienia</div>
                    <div id="success-to-main-site">Przejdź do <a href="index.php">strony głównej</a></div>
                </div>
            </div>
			<?php
            footer();
            ?>
		</div>
	</body>
</html>