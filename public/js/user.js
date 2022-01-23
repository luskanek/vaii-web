function loadItems(owned) {
    $.ajax({
        type: "GET",
        url: "?c=user&a=getUserItems&p=" + $("#user-id").text(),
        dataType: "json",
        success: function(response) {
            if (response.length == 0) {
                owned ? $("#ads").append("<p>Nemáte zverejnené žiadne inzeráty</p>") : $("#ads").append("<p>Užívateľ nemá zverejnené žiadne inzeráty</p>");
            } else {
                let html = "";
                
                for (let i = 0; i < response.length; i++) {
                    html += "<div class='item'>"
                         + "<p>" + response[i].title + "</p>";

                    if (owned) {
                        html += "<div class='icons'>"
                              + "<a href='?c=editor&p=" + response[i].id + "'><i class='fas fa-edit'></i></a>" 
                              + "<a href='?c=editor&a=delete&p=" + response[i].id + "'><i class='fas fa-trash'></i></a>"
                              + "</div>"
                              + "</div>";
                    } else {
                        html += "</div>";
                    }
                }

                $("#ads").append(html);
            }
        }
    });
}

function loadReviews() {
    $.ajax({
        type: "GET",
        url: "?c=user&a=getUserReviews&p=" + $("#user-id").text(),
        dataType: "json",
        success: function(response) {
            if (response.length == 0) {
                $("#reviews").append("<p>Žiadne hodnotenia</p>");
            } else {
                for (let i = 0; i < response.length; i++) {
                    let review = response[i];
                    let id = "";

                    $.ajax({
                        type: "GET",
                        url: "?c=user&a=getUserDetails&p=" + review.author,
                        dataType: "json",
                        async: false,
                        success: function(tmp_response) {
                            id = review.author;
                            review.author = tmp_response.name;
                        }
                    });

                    let html = "<div class='review'>"
                             + "<a href='?c=user&a=profile&p=" + id + "'>" + review.author + "</a>"
                             + "<p>" + review.content + "</p>"
                             + "</div>";

                    $("#reviews").append(html);
                }
            }
        }
    });
}

function updatePhone() {
    let numb = $("#user-phone");
    let input = $("#user-input-phone");
    let edit = $("#user-phone-update");
    let conf = $("#user-phone-confirm");
    
    if (input.is(":visible")) {
        $.ajax({
            type: "GET",
            url: "?c=user&a=updatePhone&u=" + $("#user-id").text() + "&p=" + input.val(),
            success: function(response) {
                alert("Vaše telefónne číslo bolo aktualizované!");

                numb.html(input.val());
                input.hide();
                conf.hide();
                numb.show();
                edit.show();
            }
        });
    } else {
        numb.hide();
        edit.hide();
        conf.show();

        input.val($("#user-phone").text());
        input.show();
    }
}

function showEditor() {
    $(".review").hide();
    $("#editor").show();
}