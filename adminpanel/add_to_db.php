<?php
session_start();

include_once "template-elements.php";
require_once "./../connect.php";
function categories_list()
{
    require "./../connect.php";
    try
    {
        $connect = @new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connect->connect_errno != 0)
        {
            throw new exception(mysqli_connect_errno());
        }
        else
        {
            $sql = sprintf("SELECT * FROM categories");
            if($result = $connect->query($sql))
            {
                foreach($result as $row)
                {
                    echo "<div class=\"list-object\">
                    <div class=\"list-object-photo\"></div>
                    <div class=\"list-object-title\">".$row['category']."</div>
                </div>";
                }
            }
            $connect->close();
        }
    }
    catch (exception $e)
    {
        echo $e;
    }
}
function categories_list_add()
{
    require "./../connect.php";
    try
    {
        $connect = @new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connect->connect_errno != 0)
        {
            throw new exception(mysqli_connect_errno());
        }
        else
        {
            $sql = sprintf("SELECT * FROM categories");
            if($result = $connect->query($sql))
            {
                foreach($result as $row)
                {
                    echo "<option>".$row['category']."</option>";
                }
            }
            $connect->close();
        }
    }
    catch (exception $e)
    {
        echo $e;
    }
}
function category_to_id($category)
{
    require "./../connect.php";
    try
    {
        $connect = @new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connect->connect_errno != 0)
        {
            throw new exception(mysqli_connect_errno());
        }
        else
        {
            $sql = sprintf("SELECT id FROM categories WHERE category='$category'");
            $return;
            if($result = $connect->query($sql))
            {
                $row = $result->fetch_assoc();
                $return = $row['id'];
                return $return;
            }
            $connect->close();

        }
    }
    catch (exception $e)
    {
        echo $e;
    }
}
?>
<?php


if(isset($_POST["submit"]))
{
    try
    {
        if(isset($_FILES["photo"]))
        {
            if($_FILES["photo"]["error"] == 0)
            {
                $file_name = $_FILES['photo']['name'];
                $title = $_POST['title'];
                $ingredients = $_POST['ingredients'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $subcategory;
                $subsubcategory;
                $connect = @new mysqli($db_host, $db_user, $db_password, $db_name);
                $connect->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
                if($connect->connect_errno != 0)
                {
                    throw new exception($connect->error);
                }

                else
                {
                    /*$sql = sprintf("SELECT id FROM categories WHERE category='$category'");
                    if($result = $connect->query($sql))
                    {
                        $row = $result->fetch_assoc();
                        $category = $row['id'];
                    }*/
                    $category = category_to_id($category);
                    $sql = sprintf("INSERT INTO products(id, photo, title, ingredients, price, category) values(NULL, '$file_name', '$title', '$ingredients', '$price', '$category')");
                    if($connect->query($sql))
                    {
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "./../pizza-photos/".$file_name);
                    }
                }

            }
            else
            {
                echo $_FILES['photo']['error'];
            }
        }
        else
        {
            $e = "Nie dodano pliku";
        }
    }
    catch (exception $e)
    {
        echo $e;
    }
}
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="Stylesheet" href="style-adminpanel.css" type="text/css" />
        <link rel="Stylesheet" href="style-addtodb.css" type="text/css" />
        <link rel="Stylesheet" href="fontello/css/fontello.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&display=swap&subset=latin-ext" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>DiMaggio</title>
        <script>
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
        function preview_title()
        {
            var value = $("#title").val();
            $("#item-title").html(value);
            if(value == "")
            {
                $("#item-title").html("Tytuł");
            }
            submit_check();
        }
        function preview_ingredients()
        {
            var value = $("#ingredients").val();
            $("#item-ingredients").html(value);
            if(value == "")
            {
                $("#item-ingredients").html("Składniki, składniki, składniki, składniki, składniki");
            }
            submit_check();
        }
        function preview_price()
        {
            var value = $("#price").val();
            if(isNaN(value) == true)
            {
                value = value.substring(0, value.length - 1);
                $("#price").val(value);
            }
            $("#item-price").html(value+" zł");

            if(value == "")
            {
                $("#item-price").html("0 zł");
            }
            submit_check();
        }
        function submit_check()
        {
            var error = 0;
            if($("#title").val() == "")
            {
                error = 1;
            }
            if($("#price").val() == "")
            {
                error = 1;
            }
            if($("#category").val() == "")
            {
                error = 1;
            }
            if(error == 0)
            {
                $("#submit").prop("disabled", false);
            }
            else
            {
                $("#submit").prop("disabled", true);
            }

        }
        </script>
    </head>
    <body>
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
                <div id="left">
                    <div class="list list-cat">

                        <div class="list-object">
                            <div class="list-object-photo">
                                <img src="pizzapreview.png" alt="add-cat"/>
                            </div>
                            <div class="list-object-title">Dodaj kategorię</div>
                        </div>
                        <div class="list-object">
                            <div class="list-object-photo"></div>
                            <div class="list-object-title">Lorem ipsum dolor sit amet.</div>
                        </div>
                        <?php categories_list(); ?>
                    </div>
                    <div class="list list-product"></div>
                </div>
                <div id="right">
                    <div id="site-title">Dodaj do bazy danych</div>
                    <form id="add-to-db" method="post" enctype="multipart/form-data">
                        <input type="file" accept="image/x-png" name="photo" id="photo"/>
                        <input oninput="preview_title()" id="title" name="title" type="text" placeholder="Tytuł"/>
                        <input oninput="preview_ingredients()" id="ingredients" name="ingredients" type="text" placeholder="Składniki"/>
                        <input oninput="preview_price()" id="price" name="price" type="text" placeholder="Cena"/>
                        <select id="category" name="category" onchange="submit_check()">
                            <option></option>
                            <?php categories_list_add(); ?>
                        </select>
                        <div id="item-preview">
                            <div id="item-container">
                                <div id="item-border-line">
                                    <div id="item-photo">
                                        <img id="photo-preview1" src="pizzapreview.png" />
                                    </div>
                                    <div id="item-content">
                                        <div id="item-title">Tytuł</div>
                                        <div id="item-ingredients">Składniki, składniki, składniki, składniki, składniki</div>
                                        <div id="item-down">
                                            <div id="item-price">0 zł</div>
                                            <div id="item-order-button">
                                                <div id="item-order-button-border">
                                                    <div onclick="preview_title()" id="item-order-button-name">Zamów</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input oninput="preview_price()"type="submit" id="submit" name="submit" value="Dodaj do bazy" disabled/>
                        <div id="check"></div>
                    </form>
                </div>

            </div>
        </div>
    </body>
    <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#photo-preview1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#photo").change(function() {
      readURL(this);
    });
    </script>
</html>
