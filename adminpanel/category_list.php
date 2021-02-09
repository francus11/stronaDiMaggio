<?php

if (isset($_POST['category_id']))
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
            $category = $_POST['category_id'];
            $sql = sprintf("SELECT id, photo, title FROM products WHERE category='$category' order by id ");

            if($result = $connect->query($sql))
            {
                $row;
                $a = array();
                $i = 0;
                while($row = $result->fetch_assoc())
                {
                    $a[$i] = $row;
                    $i++;
                }
                echo json_encode($a);
            }
            $connect->close();
        }
    }
    catch (exception $e)
    {
        echo json_encode(array("error" => $e));
    }
}
if (isset($_POST['select_item']))
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
            $id = $_POST['select_item'];
            $sql = sprintf("SELECT products.id, photo, title, ingredients, price, categories.category FROM products LEFT JOIN categories ON products.category = categories.id WHERE products.id='$id' ");

            if($result = $connect->query($sql))
            {
                $row = $result->fetch_assoc();
                echo json_encode($row);
            }
            $connect->close();
        }
    }
    catch (exception $e)
    {
        echo json_encode(array("error" => $e));
    }
}
if (isset($_POST['delete_item']))
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
            $id = $_POST['delete_item'];
            $sql = sprintf("SELECT photo FROM products WHERE id='$id' ");

            if($result = $connect->query($sql))
            {
                if ($row = $result->fetch_assoc()) {
                    if(file_exists("../pizza-photos".$row['photo']))
                    {
                        unlink("../pizza-photos".$row['photo']);
                    }
                }
                else
                {
                    echo "NO Photo";
                }
            }

            $sql = sprintf("DELETE FROM products WHERE id='$id'");

            if($result = $connect->query($sql))
            {
                echo "success";
            }
            $connect->close();
        }
    }
    catch (exception $e)
    {
        echo json_encode(array("error" => $e));
    }
}
/*if (isset($_POST['delete_item']))
{
    if(file_exists())
    {

    }
//    unlink('test.txt');
    echo "success";
}*/
if (isset($_POST['category_id_to_category'])) {
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
            $category_id = $_POST['category_id_to_category'];
            $sql = sprintf("SELECT category FROM categories WHERE id='$category_id'");
            $return;
            if($result = $connect->query($sql))
            {
                $row = $result->fetch_assoc();
                $return = $row['category'];
                echo $return;
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
