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
?>
