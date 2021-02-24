<?php
session_start();

include_once "../template-elements.php";
require_once "./../connect.php";
include_once "category_list.php";
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
                    echo "<div class=\"list-object\" onclick=\"product_list(".$row['id'].")\">
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
                $return;
                if(!is_null($row))
                {
                    $return = $row['id'];
                    return $return;
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
?>
<?php

//wysyłanie itemu do bazy
if(isset($_POST["submit_add"]))
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
//dodanie kategorii
if(isset($_POST["submit_add_category"]))
{
    try
    {
        $category_name = $_POST['add_category_name'];
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
            $sql = sprintf("INSERT INTO categories(id, category) values(NULL, '$category_name')");
            if($connect->query($sql))
            {

            }
        }
    }
    catch (exception $e)
    {
        echo $e;
    }
}
//modyfikacja itemu
if(isset($_POST["submit_modify"]))
{
    try
    {
        if(isset($_FILES["photo"])) // ze zmianą obrazka
        {
            if($_FILES["photo"]["error"] == 0)
            {
                $id = $_POST['modify_item_id'];
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
                    $category = category_to_id($category);
                    $sql = sprintf("UPDATE products SET photo = '$file_name', title='$title', ingredients='$ingredients', price='$price', category='$category' WHERE id='$id'");
                    if($connect->query($sql))
                    {
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "./../pizza-photos/".$file_name);
                    }
                }
            }
            else //bez zmiany obrazka
            {
                $id = $_POST['modify_item_id'];
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
                    $category = category_to_id($category);
                    $sql = sprintf("UPDATE products SET title='$title', ingredients='$ingredients', price='$price', category='$category' WHERE id='$id'");
                    if($connect->query($sql))
                    {

                    }
                }
            }
        }
    }
    catch (exception $e)
    {
//        echo $e;
    }
}
if (isset($_POST['submit_delete_category']))
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
            $id = $_POST['category'];
            $id = category_to_id($id);
            $sql = sprintf("SELECT id FROM products WHERE category='$id' ");
            if($result = $connect->query($sql))
            {
                foreach($result as $row)
                {
                    $sql = sprintf("UPDATE products SET category=NULL WHERE category='$id' ");
                    if($result = $connect->query($sql))
                    {

                    }
                }
            }


            $sql = sprintf("DELETE FROM categories WHERE id='$id'");

            if($result = $connect->query($sql))
            {

            }
            $connect->close();
        }
    }
    catch (exception $e)
    {
        echo json_encode(array("error" => $e));
    }
}
?>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="Stylesheet" href="style-adminpanel.css" type="text/css" />
    <link rel="Stylesheet" href="style-addtodb.css" type="text/css" />
    <link rel="Stylesheet" href="fontello/css/fontello.css" type="text/css" />
    <link rel="Stylesheet" href="../fontello-close/css/fontello.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&display=swap&subset=latin-ext" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>DiMaggio</title>
    <script id="add_item" type="text/html">
        <div id="site-title">Dodaj do bazy danych</div>
        <form id="add-to-db" method="post" enctype="multipart/form-data">
            <input type="file" accept="image/x-png" name="photo" id="photo" onchange="readURL(this)"/>
            <input oninput="preview_title()" id="title" name="title" type="text" placeholder="Tytuł" />
            <input oninput="preview_ingredients()" id="ingredients" name="ingredients" type="text" placeholder="Składniki" />
            <input oninput="preview_price()" id="price" name="price" type="text" placeholder="Cena" />
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
                                        <div id="item-order-button-name">Zamów</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input oninput="preview_price()" type="submit" id="submit" name="submit_add" value="Dodaj do bazy" disabled />
            <div id="check"></div>
        </form>
    </script>
    <script id="modify_item" type="text/html">
        <div id="site-title">Edytuj przedmiot</div>
        <form id="add-to-db" method="post" enctype="multipart/form-data">
            <input type="hidden" id="item_id" name="modify_item_id" value="">
            <input type="file" accept="image/x-png" name="photo" id="photo" onchange="readURL(this)"/>
            <input oninput="preview_title()" id="title" name="title" type="text" placeholder="Tytuł" />
            <input oninput="preview_ingredients()" id="ingredients" name="ingredients" type="text" placeholder="Składniki" />
            <input oninput="preview_price()" id="price" name="price" type="text" placeholder="Cena" />
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
                                        <div id="item-order-button-name">Zamów</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input oninput="preview_price()" type="submit" id="submit" name="submit_modify" value="Dodaj do bazy" disabled />
            <div class="delete_button">Usuń przedmiot</div>
            <div id="check"></div>
        </form>
    </script>
    <script class="add_category" type="text/html">
        <form id="add_category_form" method="post">
            <input type="text" name="add_category_name" placeholder="Nazwa kategorii">
            <input type="submit" name="submit_add_category">
        </form>
    </script>
    <script class="delete_category" type="text/html">
        <form id="add_category_form" method="post">
            <select class="category_delete" name="category" onchange="delete_category_onchange()">
                <option>-wybierz-</option>
                <?php categories_list_add(); ?>
            </select>
            <input class="submit_delete_category1" type="submit" name="submit_delete_category" disabled>
        </form>
    </script>
    <script>
        function expandMenu()
        {
            var x = document.getElementById("side-bar");
            if (x.style.display === "block")
            {
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
            if (value == "")
            {
                $("#item-title").html("Tytuł");
            }
            submit_check();
        }

        function preview_ingredients()
        {
            var value = $("#ingredients").val();
            $("#item-ingredients").html(value);
            if (value == "")
            {
                $("#item-ingredients").html("Składniki, składniki, składniki, składniki, składniki");
            }
            submit_check();
        }

        function preview_price()
        {
            var value = $("#price").val();
            if (isNaN(value) == true)
            {
                value = value.substring(0, value.length - 1);
                $("#price").val(value);
            }
            $("#item-price").html(value + " zł");

            if (value == "")
            {
                $("#item-price").html("0 zł");
            }
            submit_check();
        }

        function submit_check()
        {
            var error = 0;
            if ($("#title").val() == "")
            {
                error = 1;
            }
            if ($("#price").val() == "")
            {
                error = 1;
            }
            if ($("#category").val() == "")
            {
                error = 1;
            }
            if (error == 0)
            {
                $("#submit").prop("disabled", false);
            }
            else
            {
                $("#submit").prop("disabled", true);
            }

        }
        function product_list(id)
        {
            $.ajax(
            {
                type: 'post',
                url: 'category_list.php',
                dataType: 'json',
                data:
                {
                    category_id: id
                },
                success: function(response)
                {
                    console.log(response);
                    $('.list-product').html("<div class=\"list-object\" onclick=\"add_product()\"><div class=\"list-object-photo\"></div><div class=\"list-object-title\">Dodaj przedmiot</div></div>");
                    for (i = 0; i < response.length; i++)
                    {
                        var listOfProducts = $('.list-product');
                        var insertedHTML = "<div class=\"list-object\" onclick=\"edit_product(" + response[i].id + ")\"><div class=\"list-object-photo\"><img src=\"../pizza-photos/" + response[i].photo + "\" alt=\"add-cat\" /></div><div class=\"list-object-title\">" + response[i].title + "</div></div>";
                        listOfProducts.append(insertedHTML);
                    }
                }
            });
        }
        function add_product()
        {
            var insert = $("#add_item").html();
            $("#right").html(insert);
        }
        //TODO importować ustawiony obrazek do pamięci. Przyda się również jakas galeria do wyboru ze zdjęć już dostępnych z bazy
        //TODO podmieniać zdjęcie przy modyfikacji rekordu #1. Już wyświetla bazowy obraz
        function delete_product(id)
        {

            $.ajax(
            {
                type: 'post',
                url: 'category_list.php',
                data:
                {
                    delete_item: id
                },
                success: function(response)
                {
                    console.log(response);
                    window.location = "add_to_db.php";
                }
            });
        }
        function delete_category_onchange()
        {
            if ($(".category_delete").val() == "-wybierz-")
            {
                console.log(1);
                $(".submit_delete_category1").prop("disabled", true);
            }
            else
            {
                $(".submit_delete_category1").prop("disabled", false);
            }
        }
        function edit_product(id)
        {
            var insert = $("#modify_item").html();
            $("#right").html(insert);
            $("#item_id").prop("value", id);
            $.ajax(
            {
                type: 'post',
                url: 'category_list.php',
                dataType: 'json',
                data:
                {
                    select_item: id
                },
                success: function(response)
                {
                    $("#title").val(response.title);
                    $("#ingredients").val(response.ingredients);
                    $("#price").val(response.price);
                    $("#category").val(response.category);
                    console.log(response.category);
                    preview_title();
                    preview_ingredients();
                    preview_price();
                    var ins = "delete_product(" + id + ")";
                    $("#delete_button").attr("onclick", ins);
                    var ins1 = "../pizza-photos/" + response.photo;
                    $("#photo-preview1").attr("src", ins1);
                }
            });

        }
        function add_category()
        {
            popup();
            var insert = $(".add_category").html();
            $(".choosebox-title-text").html("Dodaj kategorię");
            $(".choosebox-content").html(insert);
        }
        function delete_category(id)
        {
            popup();
            var insert = $(".delete_category").html();
            $(".choosebox-title-text").html("Usuń kategorię");
            $(".choosebox-content").html(insert);
        }
        function delete_category2(id)
        {

            $.ajax(
            {
                type: 'post',
                url: 'category_list.php',
                data:
                {
                    delete_category: id
                },
                success: function(response)
                {
                    console.log(response);
                    window.location = "add_to_db.php";
                }
            });
        }
        function popup()
        {
            if ($("body .choosebox").length)
            {
                $(".choosebox").remove();
                return $("body .choosebox").length;
            }
            else
            {
                var x = $(".popup").html();
                $("body").prepend(x);
                return $("body .choosebox").length;
            }
        }
    </script>
    <script class="popup" type="text/html">
    <div class="choosebox" >
        <div class="choosebox-container">
            <div class="choosebox-title">
                <i class="icon-cancel choosebox-title-element" onclick="popup()"></i>
                <div class="choosebox-title-text">Tytuł</div>
                <div class="choosebox-title-element"></div>
            </div>
            <div class="choosebox-content">

            </div>
        </div>
    </div>
    </script>
    <script>
        function readURL(input)
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader();

                reader.onload = function(e)
                {
                    $('#photo-preview1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
            else
            {
                console.log("spr")
            }
        }
    </script>
</head>

<body>

    <div id="container">
        <div id="header">
            <div id="menu">
                <!-- FUTURE na mobilnych ma wysuwać się z boku i przesuwać całą stronę w prawo-->
                <div id="side-bar-onclick" onclick="expandMenu()"></div>
            </div>
        </div>

        <div id="side-bar">
            <a href="">
                <div class="side-bar-option"></div>
            </a>
            <a href="">
                <div class="side-bar-option"></div>
            </a>
        </div>
        <div id="content">
            <div id="left">
                <div class="list list-cat">
                    <div class="list-object" onclick="add_category()">
                        <div class="list-object-photo">
                            <img src="pizzapreview.png" alt="add-cat" />
                        </div>
                        <div class="list-object-title" >Dodaj kategorię</div>
                    </div>
                    <?php categories_list(); ?>
                    <div class="list-object" onclick="product_list(0)">
                        <div class="list-object-photo">
                            <img src="pizzapreview.png" alt="add-cat" />
                        </div>
                        <div class="list-object-title" >Bez kategorii</div>
                    </div>
                    <div class="delete_button" onclick="delete_category()">Usuń kategorię</div>
                </div>
                <div class="list list-product">
                    <div class="list-object add_category" onclick="add_product()">
                        <div class="list-object-photo"></div>
                        <div class="list-object-title">Dodaj przedmiot</div>
                    </div>
                </div>
            </div>
            <div id="right"></div>

        </div>
    </div>
</body>


</html>
