<?php
require __DIR__ . '/Lib/product.php';

$obj=new product();
$products=$obj->getAllProducts();
?>
<?php require 'Layout/header.php'; ?>
<div class="main">
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <div>
                <span class="m-2" style="font-size: x-large">Products List</span>
                <span class="float-end"><button class="btn my-btn m-2" onclick="document.location.href='/addProduct.php'">ADD</button><button class="btn my-btn m-2" id="delete-product-btn" onclick="massDelete()" >MASS DELETE</button></span>
            </div>
            <hr style="width: 100%;" class="m-auto mt-1">
            <div class="product-list mt-4 ms-auto me-auto">
                <?php foreach ($products as $product): ?>
                <span class="card d-inline-flex ms-2 mt-2">
                        <div class="form-check m-2">
                        <input class="form-check-input delete-checkbox" type="checkbox" value="<?php echo $product['SKU_id'] ?>">
                    </div>
                    <div class="card-body text-center " id="body">
                    <p id=""><?php echo $product['SKU_id'] ?></p>
                    <p id=""><?php echo $product['name'] ?></p>
                    <p id=""><?php echo $product['price']." $" ?></p>
                            <span><?php echo ($product['weight']) ? "Weight: ".$product['weight']."KG":"" ?></span>
                            <span><?php echo ($product['size']) ? "Size: ".$product['size']." MB":"" ?></span>
                            <span><?php echo (($product['height']) ? "Dimension: ".$product['height'] . "x" : " ").(($product['width']) ? $product['width'] . "x" : " ").(($product['length']) ? $product['length'] : "")  ?></span>
                    </div>
                </span>
                <?php endforeach; ?>
                <?php
                if(count($products)==0)
                    echo "<h2 class='text-center'>We didn't find andy products to show</h2>"
                ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php require 'Layout/footer.php'; ?>
<script src="Js/ListProducts.js"></script>
