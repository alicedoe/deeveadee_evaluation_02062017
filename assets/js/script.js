$( document ).ready(function() {
    $('#logout,#login').click(function() {
        $action = $(this).attr('id');
        window[$action]();
        });
    $('#registration').click(function() {
        registration();
    });

    $('#login').click(function() {
        login();
    });

    $('#logout').click(function() {
        logout();
    });
});

function registration() {
    $.ajax({
        url: '/Userscontroller/registration',
        type: 'POST',
        data: {"nomC": $('#formRegistration input[name=nomC]').val(),"prenomC": $('#formRegistration input[name=prenomC]').val(),"adresseC": $('#formRegistration input[name=adresseC]').val(),"emailC": $('#formRegistration input[name=emailC]').val(),"motdepasseC": $('#formRegistration input[name=motdepasseC]').val()},
        success: function (data) {
            if(data["isUserCreated"]) {
                console.log(data);
                $('#blocUser').empty().append("<span class'middlehor'>Bonjour "+data["prenom"]+" !</span>");
                deco = "<button id='logout' class='btn btn-primary'>Se deconnecter</button>";
                $('#blocUser').append(deco);
                $('#logout').click(function() {
                    logout();
                });
                $('#popinCreateAccount').modal('hide')
            }
            else {
                $('.error').append(data['error_msg'])
            }
        },
        error: function (data) {
            console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
        }
    });
}

function updateProfil(id) {
    idabo= $('#aboselect').val();
    nomC= $('#nomC').val();
    prenomC= $('#prenomC').val();
    emailC= $('#emailC').val();
    adresseC= $('#adresseC').val();

    $.ajax({
        url: '/Userscontroller/updateabo',
        type: 'POST',
        data: {"idabo": idabo,"iduser": id, "nomC": nomC, "prenomC": prenomC, "emailC": emailC, "adresseC": adresseC},
        success: function (data) {
            location.reload();
        },
        error: function (data) {
            console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
        }
    });
}


function login() {
    $.ajax({
        url: '/Userscontroller/login',
        type: 'POST',
        data: {"emailC": $('.loginForm input[name=login_username]').val(),"motdepasseC": $('.loginForm input[name=login_password]').val()},
        success: function (data) {
            if(data["isUserLoggedIn"]) {
                location.reload();
            }
            else {
                $('.error').append(data['error_msg'])
            }

        },
        error: function (data) {
            console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
        }
    });
}

function logout() {
    $.ajax({
        url: '/Userscontroller/logout',
        success: function (data) {
            location.reload();
            },
        error: function (data) {
            console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
        }
    });
}


function checksession() {
    $.ajax({
        url: '/Welcomecontroller/checkSession',
        success: function (data) {
            return data;
        },
        error: function (data) {
            console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
        }
    });
}