window.onload = function() {
    fetch('?c=user&a=getUserAds')
        .then(response => response.json())
        .then(data => {
            let html = "<h2>Moje inzeráty</h2>";

            for (let ad of data) {
                html += "<div class='item'>"
                        + "<a href=''>" + ad.title + "</a>"
                        + "<div class='icons'>"
                        + "<a href='' style='padding-right: 5px'><i class='fas fa-edit'></i></a>"
                        + "<a href=''><i class='fas fa-trash'></i></a>"
                        + "</div"
                        + "</div>";
            }

            document.getElementById("ads").innerHTML = html;
        }
    );
}