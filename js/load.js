$(function () {
    $('#showMore').click(function (event) {
        event.preventDefault();
        $number = $('.result').size();

        $.ajax({
            type: "POST",
            url: "system/getNext.php",
            data: "count=$number",
            success: function (results) {
                $('#results').append(results);
            }
        });

    });

});