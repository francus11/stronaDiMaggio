<html lang="pl">
	<head>
		<meta charset="utf-8">
		<link rel="Stylesheet" href="style-test.css" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script>
            var item = [
                ["Margarita", "01-1.png"],
                ["Capriciosa", "02-1.png"],
                ["Fungi", "03-1.png"]        
            ];
            var num1 = 0;
            var num2 = 1;
            var num3 = 2;
            function left()
            {
                
                num1 = num1 + 1;
                if(num1 > item.length - 1){
                    num1 = 0;
                }
                num2 = num2 + 1;
                if(num2 > item.length - 1){
                    num2 = 0;
                }
                num3 = num3 + 1;
                if(num3 > item.length - 1){
                    num3 = 0;
                }
                document.getElementById("left").innerHTML = "<img src=\"pizza-photos/"+item[num1][1]+"\" />";
                document.getElementById("center").innerHTML = "<img src=\"pizza-photos/"+item[num2][1]+"\" />";
                document.getElementById("right").innerHTML = "<img src=\"pizza-photos/"+item[num3][1]+"\" />";
            }
            function right()
            {
                num1 = num1 - 1;
                if(num1 < 0){
                    num1 = item.length - 1;
                }
                num2 = num2 - 1;
                if(num2 < 0){
                    num2 = item.length - 1;
                }
                num3 = num3 - 1;
                if(num3 < 0){
                    num3 = item.length - 1;
                }
                document.getElementById("left").innerHTML = "<img src=\"pizza-photos/"+item[num1][1]+"\" />";
                document.getElementById("center").innerHTML = "<img src=\"pizza-photos/"+item[num2][1]+"\" />";
                document.getElementById("right").innerHTML = "<img src=\"pizza-photos/"+item[num3][1]+"\" />";
            }
        </script>
	</head>
	<body>
        <div id="gallery">
           <div id="left" onclick="left()"><img src="pizza-photos/01-1.png"/></div>
           <div id="center"><img src="pizza-photos/02-1.png"/></div>
           <div id="right" onclick="right()"><img src="pizza-photos/03-1.png"/></div>
        </div>
        <div id="check"></div>
	</body>
</html>