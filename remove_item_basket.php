<?php
session_start();

$numb = $_POST['remove_item'];
unset($_SESSION['basket_id'][$numb]);
$_SESSION['basket_id'] = array_values($_SESSION['basket_id']);
if(count($_SESSION['basket_id']) == 0)
{
    unset($_SESSION['basket_id'], $_SESSION['count']);
}
echo "0";

?>