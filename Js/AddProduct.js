document.title = "Shopping Line-Add a product";
let typeSwitch;
typeSwitch = $('#productType').val();
$('#productType').change(function () {
    typeSwitch = $('#productType').val();
    showTemplate(typeSwitch);
});

function showTemplate(selected) {
    if (selected === "DVD") {
        $('#DVD').show();
        $('#Furniture').hide();
        $('#Book').hide();
    } else if (selected === "Furniture") {
        $('#Furniture').show();
        $('#DVD').hide();
        $('#Book').hide();
    } else if (selected === "Book") {
        $('#Book').show();
        $('#DVD').hide();
        $('#Furniture').hide();
    }
}

function validate() {
    let requiredError = "Please, submit required data.";
    let invalidDataError = "Please, provide the data of indicated type.";
    let isValid = true;
    let regexPattern = /(\d+(?:\.\d+)?)/;

    if ($('#sku').val() === "") {
        $('#sku-error').html(requiredError);
        isValid = false;
    } else {
        let check = checkSku();
        if (check) {
            $('#sku-error').html("duplicate SKU code, SKU code have to be unique.");
            isValid = false;
        }
    }

    if ($('#name').val() === "") {
        $('#name-error').html(requiredError);
        isValid = false;
    }

    if ($('#price').val() === "") {
        $('#price-error').html(requiredError);
        isValid = false;
    } else {
        if (!regexPattern.test($('#price').val())) {
            $('#price-error').html(invalidDataError);
            isValid = false;
        }
    }
    if (typeSwitch === "DVD") {
        if ($('#size').val() === "") {
            $('#size-error').html(requiredError);
            isValid = false;
        } else {
            if (!regexPattern.test($('#size').val())) {
                $('#size-error').html(invalidDataError);
                isValid = false;
            }
        }
    } else if (typeSwitch === "Furniture") {
        if ($('#height').val() === "") {
            $('#height-error').html(requiredError);
            isValid = false;
        } else {
            if (!regexPattern.test($('#height').val())) {
                $('#height-error').html(invalidDataError);
                isValid = false;
            }
        }
        if ($('#width').val() === "") {
            $('#width-error').html(requiredError);
            isValid = false;
        } else {
            if (!regexPattern.test($('#width').val())) {
                $('#width-error').html(invalidDataError);
                isValid = false;
            }
        }
        if ($('#length').val() === "") {
            $('#length-error').html(requiredError);
            isValid = false;
        } else {
            if (!regexPattern.test($('#length').val())) {
                $('#length-error').html(invalidDataError);
                isValid = false;
            }
        }
    } else if (typeSwitch === "Book") {
        if ($('#weight').val() === "") {
            $('#weight-error').html(requiredError);
            isValid = false;
        } else {
            if (!regexPattern.test($('#weight').val())) {
                $('#weight-error').html(invalidDataError);
                isValid = false;
            }
        }
    }

    return isValid;
}

function saveProduct() {
    $('#sku-error').html("")
    $('#name-error').html("")
    $('#price-error').html("")
    if (typeSwitch === "DVD") {
        $('#size-error').html("")
    } else if (typeSwitch === "Furniture") {
        $('#height-error').html("")
        $('#width-error').html("")
        $('#length-error').html("")
    } else if (typeSwitch === "Book") {
        $('#weight-error').html("")
    }

    $('#product_form').submit();
}

function cancelSave() {
    try {
        $('#product_form').abort();
        window.location.href = "/";
    } catch (ex) {
        window.location.href = "/";
    }
}

function checkSku() {
    let isDuplicate = false;
    let sku = $('#sku').val();
    $.ajax({
        type: "POST",
        url: "/Actions/checkSku.php",
        data: {
            "sku": sku,
        },
        async: false,
        success: function (result) {
            if (result > 0)
                isDuplicate = true
        },
        dataType: "json"
    });
    return isDuplicate;
}