<?php
require '../Lib/product.php';

$obj=new product();
$obj->checkDuplicates($_POST['sku']);
