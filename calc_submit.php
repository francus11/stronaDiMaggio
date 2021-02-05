<?php
session_start();
if(isset($_POST['calc']))
{
    if(isset($_SESSION['basket_id']))
    {
        
        $sum = 0;
        $count = count($_SESSION['basket_id']);
        for($i = 0; $i < $count; $i++)
        {
            require "connect.php";
            try
            {
                $connect = new mysqli($db_host, $db_user, $db_password, $db_name);
                $connect-> query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
                if($connect->connect_errno != 0)
                {
                    throw new exception(mysqli_connect_errno());
                }
                else
                {
                    $item_id = $_SESSION['basket_id'][$i];
                    $sql = sprintf("SELECT price FROM products WHERE id='$item_id'");
                    if($result = $connect->query($sql))
                    {
                        $row = $result->fetch_assoc();
                        $math = $row['price'];
                        $sum = $sum + $math;
                        
                    }
                    $connect->close();
                }
            }
            catch(exception $e)
            {
                echo $e;
            }
        }
        $sum = $sum + 10;
        $_SESSION['sum_price'] = $sum;
        echo number_format($sum, 2, '.', ' ')." zł";
    }
    else
    {
        echo '10.00 zł';
    }
}
else
{
    
}
?>
