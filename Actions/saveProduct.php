<?php
session_start();
require '../Lib/product.php';
require '../Lib/DVD.php';
require '../Lib/Book.php';
require '../Lib/Furniture.php';


$switchType=$_POST["switch-input"];

    $obj = new $switchType($_POST);
    $response = $obj->save();
