window.onload = function() {
    fetch('?a=getAllCategories')
        .then(response => response.json())
        .then(data => {
            document.getElementById("categories").style.display = "grid";
            document.getElementById("items").style.display = "none";

            let html = "";

            for (let category of data) {
                html += "<div class='section'>"
                        + "<i class='" + category.icon + "'></i>"
                        + "<h3>" + category.name + "</h3>"
                        + "<p>" + category.description + "</p>"
                        + "</div>";
            }

            document.getElementById("categories").innerHTML = html;
        }
    );
}