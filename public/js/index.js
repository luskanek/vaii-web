window.onload = function() {
    fetch('?a=getAllCategories')
        .then(response => response.json())
        .then(data => {
            document.getElementById("categories").style.display = "grid";
            document.getElementById("items").style.display = "none";

            let html = "";

            for (let category of data) {
                html   += "<div class='section' onclick='getItems(" + category.id + ")'>"
                        + "<i class='" + category.icon + "'></i>"
                        + "<h3>" + category.name + "</h3>"
                        + "<p>" + category.description + "</p>"
                        + "</a>"
                        + "</div>";
            }

            document.getElementById("categories").innerHTML = html;
        }
    );
}

function getItems(category) {
    $("#categories").hide();
    $("#items").show();

    $.ajax({
        type: "GET",
        url: "?c=home&a=getItemsInCategory&p=" + category,
        dataType: "json",
        success: function(response) {
            for (let i = 0; i < response.length; i++) {
                let item = response[i];

                $.ajax({
                    type: "GET",
                    url: "?c=user&a=getUserName&p=" + item.author,
                    dataType: "json",
                    async: false,
                    success: function(tmp_response) {
                        item.author = tmp_response;
                    }
                });

                let img = item.files.split(";");
                let div = "<div class='item'><div class='item-image' style='background-image: url(&quot;uploads/" + img[0] + "&quot;)'></div><h3 class='title'>" + item.title + "</h3><p class='author'>" + item.author + "</p><p class='desc'>" + item.description + "</p><p class='price'>" + item.price + "€</p></div>";
                $("#items").append(div);
            }
        }
    });
}