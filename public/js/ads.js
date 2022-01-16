window.onload = function() {  
    fetch('?c=user&a=getUserItems')
        .then(response => response.json())
        .then(data => {
            let html = "<h3>Moje inzeráty</h3>";

            for (let item of data) {
                html   += "<div class='item'>"
                        + "<p>" + item.title + "</p>"
                        + "<div class='icons'>"
                        + "<a href=''><i class='fas fa-link'></i></a>" 
                        + "<a href=''><i class='fas fa-edit'></i></a>" 
                        + "<a href='?c=editor&a=delete&p=" + item.id + "'><i class='fas fa-trash'></i></a>"
                        + "</div>"; 
                        + "</div>";
            }

            document.getElementById("ads").innerHTML = html;
        }
    );
}