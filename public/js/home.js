window.onload = function() {
    fetch('?c=home&a=getAllCategories')
        .then(response => response.json())
        .then(data => {
            let categories = $("#categories");
            categories.show();
            $("#items").hide();

            let html = "";

            for (let category of data) {
                html += "<div class='section' onclick='getItems(" + category.id + ")'>"
                      + "<i class='" + category.icon + "'></i>"
                      + "<h3>" + category.name + "</h3>"
                      + "<p>" + category.description + "</p>"
                      + "</a>"
                      + "</div>";
            }

            categories.append(html);
        }
    );
}

function getItems(category) {
    $("#categories").hide();
    $("#items").show();
    $("#loading-category").show();

    $.ajax({
        type: "GET",
        url: "?c=home&a=getItemsInCategory&p=" + category,
        dataType: "json",
        success: function(response) {
            $("#loading-category").hide();

            if (response.length == 0) {
                $("#empty-category").show();
            } else {
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

                    let file = item.files.split(";");
                    let images = "";
                    if (file.length > 2) {
                        for (let j = 0; j < file.length - 1; j++) {
                            images += "<img src='uploads/" + file[j] + "' onclick='showModal(this)'>";
                        }
                    }

                    let html = "<div class='item'>"
                             + "<div class='item-image' style='background-image: url(&quot;uploads/" + file[0] + "&quot;)'></div>"
                             + "<div class='item-images'>"
                             + images
                             + "</div>"
                             + "<h3 class='title'>" + item.title + "</h3>"
                             + "<p class='author'>" + item.author + "</p>"
                             + "<p class='desc'>" + item.description + "</p>"
                             + "<p class='price'>" + item.price + "€</p></div>";
                    $("#items").append(html);
                }
            }
        }
    });
}

function showModal(element) {
    $("#image-modal").attr("src", $(element).attr("src"));
    $("#modal-container").show();
}

function hideModal() {
    $("#modal-container").hide();
}