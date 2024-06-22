document.title = "Shopping Line-Products List";
let selectedItems = [];
let checkboxes;

function massDelete() {
    checkboxes = document.getElementsByClassName('delete-checkbox');
    for (let i = 0; i < checkboxes.length; i++) {

        if (checkboxes[i].checked) {
            selectedItems[i] = checkboxes[i].value;
            console.log("Add");
        } else
            selectedItems.splice(i, 1);
        console.log("remove");
    }

    if (selectedItems.length > 0) {
        const XHR = new XMLHttpRequest();
        const FD = new FormData();

        let json_selected = JSON.stringify(selectedItems);

        FD.append("selectedItems", json_selected);

        // Define what happens on successful data submission
        XHR.addEventListener('load', (event) => {
            if (XHR.response) {
                location.reload();
            } else {
                document.getElementById('alert-text').innerText = "something went wrong and we couldn't delete requested items!";
                document.getElementById('alert-pop').classList.add('show');
            }
        });

        // Define what happens in case of error
        XHR.addEventListener('error', (event) => {
            document.getElementById('alert-text').innerText = "something went wrong and we couldn't sent your request!";
            document.getElementById('alert-pop').classList.add('show');

        });

        // Set up our request
        XHR.open('POST', '/Actions/massDelete.php');

        // Send our FormData object; HTTP headers are set automatically
        XHR.send(FD)
    }
}