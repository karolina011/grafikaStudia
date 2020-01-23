$(document).ready(function(){

    $(document).on('click', '#drawLine', function () {

        event.preventDefault();
        var form = $(this).parents('form:first');
        var formData = form.serializeArray();
        var data = {};

        jQuery.each( formData, function( i, val ) {
            data[val['name']] = val['value']
        });

        var func = $(this).attr('id');
        data['function'] = func;

        var url = window.location.origin + "/untitled6/index.php";

        sendAjax1(url, data, function (data) {
            var img = data.responseText;
            $('#fieldToDraw').html(img);

        });

    });


    $(document).on('click', '#clearFieldButton', function () {

        event.preventDefault();
        var data = {};
        data['function'] = 'clear';

        var url = window.location.origin + "/untitled6/index.php";

        sendAjax1(url, data, function (data) {
            var img = data.responseText;
            $('#fieldToDraw').html(img);
        });

    });

});

function sendAjax1(url, data, error)
{
    $.post({
        url: url,
        data: {data:data},
        success: function (data) {
            alert("succes");
        },
        error: error,
        dataType: "JSON"
    });
}