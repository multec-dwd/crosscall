/* jshint
browser: true,
jquery: true
*/
$(document).ready(function () {
    $("#test").click(function () {
        var imageURL = $("#url").val();

        $.get('../hotlink.php?url=' + imageURL, function (base64data) {
            $('#theimage').attr('src', 'data:image/png;base64,' + base64data);
        });
    });
});