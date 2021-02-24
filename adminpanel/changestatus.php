<?php
    function status_translate($status_id)
    {
        switch($status_id)
        {
            case 0:
                return "Oczekujące";
                break;
            case 1:
                return "Przyjęte";
                break;
            case 2:
                return "Wysłane";
                break;
            case 3:
                return "Dostarczone";
                break;
            case 4:
                return "Anulowane";
                break;

        }
    }
    require_once "../connect.php";
    try
    {
        $connect = @new mysqli($db_host, $db_user, $db_password, $db_name);

        if($connect->connect_errno != 0)
        {
            throw new exception(mysqli_connect_errno());
        }
        else
        {
            $status_id = 1;
            $sql = sprintf("SELECT * FROM orders WHERE status='$status_id'");
            $connect->query('SET NAMES utf8');
            if($result = $connect->query($sql))
            {
                if($result->num_rows >= 0)
                {
                    foreach($result as $order)
                    {
//                        $status = status_translate($order['status']);
                        $order['status']= status_translate($order['status']);
                        /*echo '<div class="order">
                    <div class="order-item">
                        <div class="order-name">'.$order['name'].'</div>
                        <div class="order-address">'.$order['address'].'</div>
                        <div class="order-zip">'.$order['zip_code'].' '.$order['city'].'</div>
                        <div class="order-phone">'.$order['phone'].'</div>
                    </div>
                    <div class="order-item">Capriciosa, Margherita, Sałatka z buraka</div>
                    <div class="order-item">'.$status.'</div>
                    <div class="order-item">
                        <div class="status-button" onclick="changeStatus()">Zmień status</div>
                    </div>
                    <div class="order-item">57.50 zł</div>
                </div>';*/
                    }
                }

            }
            $connect->close();
        }
    }
    catch(exception $e)
    {

    }
?>
