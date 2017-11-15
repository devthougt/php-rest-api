$(document).ready(function(e) {
    //e.preventDefault();

    document.getElementById('upload').addEventListener('click', function() {

        var dataObject = {
            email: document.getElementById('email').value,
            category: document.getElementById('category').value,
            image: document.getElementById('image').value

        };

        $.ajax({
            method: "POST",
            url: "./model/image-handle.php",
            dataType: "text",
            data: dataObject,
            success: function(data) {
                console.log(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

});