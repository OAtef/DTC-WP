function update(x) {

    alert(x);

    var xhttp;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "") {

        } else {
            document.getElementById("checkBoxes").innerHTML = this.responseText;
        }
        }

    }
    // xhttp.open("GET", ajaxurl+"?option="+x, true);
    xhttp.open("GET", MyAjax.ajaxurl + "?option=" + x, true);
    xhttp.send();

    }