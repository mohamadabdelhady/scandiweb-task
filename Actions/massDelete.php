<?php
require '../Lib/product.php';

$obj=new product();
$obj->deleteProducts(json_decode($_POST['selectedItems']));