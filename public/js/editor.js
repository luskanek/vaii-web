$(document).ready(function() {
    fetch('?c=home&a=getAllCategories')
        .then(response => response.json())
        .then(data => {
            for (let category of data) {
                var option = document.createElement("option");
                option.value = category.id;
                option.textContent = category.name;

                document.getElementById("select-category").appendChild(option);
            }
        }
    );

    var wrapp = $("#wrapper-images");
    var input = $("#input-new-images");
    var msg = $("#info-message");
    var extensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    
    var uploaded = 0;
    var up = 0;

    input.on("change", function(e) {
        msg.hide();

        if (up == 1) {
            if (wrapp.find("img").length > 0) {
                wrapp.find("img").remove();
                
                uploaded = 0;
            }
            up = 0;
        }

        var uploads = e.target.files;

        if (uploads.length > 10) {
            displayMessage("Môžete nahrať maximálne 10 obrázkov!");
            input.val("");
            
        } else {
            up = 1;

            for (let i = 0; i < uploads.length; i++) {
                if (!extensions.exec(input.val())) {
                    displayMessage("Môžete nahrať len obrázky!");
                    break;
                }
                
                if (uploaded > 8388608) {
                    displayMessage("Môžete nahrať len obrázky s veľkosťou do 8MB!");
                    break;  
                } 
        
                var file = uploads[i];

                var Reader = new FileReader();

                Reader.onload = function(e) {
                    var image = document.createElement("img");

                    image.src = e.target.result;
                    image.setAttribute("width", "100px");
                    image.setAttribute("height", "100px");

                    wrapp.append(image);
                };

                Reader.readAsDataURL(file);

                uploaded += input.prop("files")[i].size;
            }
        }
    });
})