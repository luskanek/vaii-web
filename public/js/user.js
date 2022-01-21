$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "?c=user&a=getUserItems",
        dataType: "json",
        success: function(response) {
            if (response.length == 0) {
                $("#ads").append("<p>Nemáte zverejnené žiadne inzeráty</p>");
            } else {
                let html = "";
                
                for (let i = 0; i < response.length; i++) {
                    html += "<div class='item'>"
                         + "<p>" + response[i].title + "</p>"
                         + "<div class='icons'>"
                         + "<a href='?c=editor&p=" + response[i].id + "'><i class='fas fa-edit'></i></a>" 
                         + "<a href='?c=editor&a=delete&p=" + response[i].id + "'><i class='fas fa-trash'></i></a>"
                         + "</div>"; 
                         + "</div>";
                }

                $("#ads").append(html);
            }
        }
    });
})

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