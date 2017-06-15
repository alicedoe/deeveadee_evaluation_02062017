$( document ).ready(function() {
    $('tbody tr td:first-child').each(function() {
        $(this).click(function() {
            detailDvd($(this).html());
        });
    });

});

function detailDvd(id) {
    $.ajax({
        url: '/Welcomecontroller/detaildvd',
        type: 'POST',
        data: {"id": id},
        success: function (data) {
            $('#detail, #note, #saisiremarque, #remarques').empty();
            $('#moyenne').empty().text(data['moyenne']);
            $(data['tab']).appendTo('#detail');
            if ( typeof(data['anote']) === 'undefined' ||data['anote'] === 0) {
                for (var i = 0; i < 6; i++) {
                    $('#note').append("<button onclick='note(" + i + "," + id + ")' class='btn btn-primary'>" + i + "</button>")
                }
            }
            $(data['rem']).appendTo('#remarques');
            if ($('#remarquesaisi').length === 0) {
            if ( typeof(data['aremarque']) === 'undefined' ||data['aremarque'] === 0) {
                $('#saisiremarque').append('<input type="text" id="remarquesaisi"  name="remarque"><button id="btnremarque" class="btn btn-primary">Envoyer</button>');
                $('#btnremarque').click(function(){ addremarque(id)});
            }
        }
        },
        error: function (data) {
            console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
        }
    });
}

function note(note,id) {
    $.ajax({
        url: '/Welcomecontroller/note',
        type: 'POST',
        data: {"note": note,"dvd": id},
        success: function (data) {
            console.log(data);
            $('#note').empty();
            $('#moyenne').empty().text(data['moyenne']);
        },
        error: function (data) {
            console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
        }
    });
}

function addremarque(id,client) {
    remarque = $('#commentaire').val();
    if ( remarque != "") {
        $.ajax({
        url: '/Welcomecontroller/remarque',
        type: 'POST',
        data: {"remarque": remarque,"dvd": id, "client": client},
        success: function (data) {
            $('#commentaire').val('');
            $('#noremarque').remove();
            $('#remarques div').last().after('<div class="col-lg-12">'+data['prenom']+' : '+remarque+'</div>');
        },
        error: function (data) {
            console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
        }
    }); }
}