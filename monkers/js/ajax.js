
function dataQty(id, size) {
    $.ajax({
        url: "./model/User.php",
        type: "post",
        dataType: 'json',
        data: {
            getQty: 1,
            itemID: id,
            size: size
        },
        success: function (data) {
            console.log(data);
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
        }
    });
}