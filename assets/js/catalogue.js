$( document ).ready(function() {
    $('tbody tr td:first-child').each(function() {
        $(this).click(function() {
            detailDvd($(this).html());
        });
    });

    $('#genre').on('change', function() {
        dvdGenre(this.value);
    })
});

function dvdGenre(id) {
    $.ajax({
        url: '/Welcomecontroller/dvdGenre',
        type: 'POST',
        data: {"id": id},
        success: function (data) {
            $('#catalogue').empty().append(data["tab"]);
        },
        error: function (data) {
            console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
        }
    });
}

function detailDvd(id) {
    $.ajax({
        url: '/Welcomecontroller/detaildvd',
        type: 'POST',
        data: {"id": id},
        success: function (data) {
            $('.detail').empty();
            $(data['tab']).appendTo('.detail');
        },
        error: function (data) {
            console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
        }
    });
}