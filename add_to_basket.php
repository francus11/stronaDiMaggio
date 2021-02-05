<?php
session_start();
function add()
{
    $_SESSION['basket_id'][]=$_POST['item_id'];
    echo "0";
}
if(isset($_POST['item_id']))
{
    if(isset($_SESSION['basket_id']))
    {
        add();
    }
    else
    {
        add();
    }
}