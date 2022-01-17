window.onload = function() {  
    fetch('?c=user&a=getUserItems')
        .then(response => response.json())
        .then(data => {
            let html = "<h3>Moje inzeráty</h3>";

            for (let item of data) {
                html   += "<div class='item'>"
                        + "<p>" + item.title + "</p>"
                        + "<div class='icons'>"
                        + "<a href='?c=editor&p=" + item.id + "'><i class='fas fa-edit'></i></a>" 
                        + "<a href='?c=editor&a=delete&p=" + item.id + "'><i class='fas fa-trash'></i></a>"
                        + "</div>"; 
                        + "</div>";
            }

            document.getElementById("ads").innerHTML = html;
        }
    );
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