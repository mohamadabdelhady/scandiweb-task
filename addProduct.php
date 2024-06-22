<?php
session_start();

require __DIR__ . '/Lib/product.php';

$obj = new product();
$products = $obj->getAllProducts();
?>
<?php require 'Layout/header.php'; ?>
<div class="main mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div>
                    <span class="m-2" style="font-size: x-large">Product Add</span>
                    <span class="float-end"><button class="btn my-btn m-2" onclick="saveProduct();">Save</button><button
                            class="btn my-btn m-2" id="cancel-save-btn" onclick="cancelSave()" ">Cancel</button></span>
                </div>
                <hr style="width: 100%;" class="m-auto mt-1">
                <span class="text-danger text-center"><?php if (isset($_SESSION['duplicateErrorMessage'])) {
                        echo $_SESSION['duplicateErrorMessage'];
                        unset($_SESSION['duplicateErrorMessage']);
                    } ?></span>
                <form class="m-auto" style="width: 60%" id="product_form" method="post"
                      action="/Actions/saveProduct.php" onsubmit="return validate();">
                    <div class="mb-3 mt-4">
                        <label for="SKU" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku-input">
                        <span class="text-danger" id="sku-error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name-input">
                        <span class="text-danger" id="name-error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price ($)</label>
                        <input type="text" class="form-control" id="price" name="price-input">
                        <span class="text-danger" id="price-error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="productType" class="form-label">Type switch</label>
                        <select class="form-select form-control" id="productType" name="switch-input">
                            <option value="DVD" selected>DVD</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Book">Book</option>
                        </select>
                    </div>
                    <!--                    <div class="mt-2" id="switch-form">-->
                    <div class="mb-3" id="DVD">
                        <label for="size" class="form-label">Size (MB)</label>
                        <input type="text" class="form-control" id="size" name="size-input">
                        <div id="emailHelp" class="form-text">Please provide size in megabytes.</div>
                        <span class="text-danger" id="size-error"></span>
                    </div>
                    <div id="Furniture" style="display: none">
                        <div class="mb-3">
                            <label for="height" class="form-label">Height (CM)</label>
                            <input type="text" class="form-control" id="height" name="height-input">
                            <span class="text-danger" id="height-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="width" class="form-label">Width (CM)</label>
                            <input type="text" class="form-control" id="width" name="width-input">
                            <span class="text-danger" id="width-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="length" class="form-label">Length (CM)</label>
                            <input type="text" class="form-control" id="length" name="length-input">
                            <span class="text-danger" id="length-error"></span>
                        </div>
                        <div id="emailHelp" class="form-text">Please provide dimension in HxWxL format.</div>
                    </div>
                    <div class="mb-3" id="Book" style="display:none;">
                        <label for="weight" class="form-label">Weight (KG)</label>
                        <input type="text" class="form-control" id="weight" name="weight-input">
                        <div id="emailHelp" class="form-text">Please provide weight in kilogram.</div>
                        <span class="text-danger" id="weight-error"></span>
                    </div>
                </form>
            </div>
        </div>
        <!--    </div>-->
    </div>
    <?php require 'Layout/footer.php'; ?>
    <script src="Js/ListProducts.js"></script>
    <script src="Js/AddProduct.js"></script>
