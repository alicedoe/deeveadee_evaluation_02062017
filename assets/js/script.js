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
    console.log(id)
    // iduser = <?php echo $user['numC']; ?>;
    // idabo= $('#aboselect').val();
    // $.ajax({
    //     url: '/Userscontroller/updateabo',
    //     type: 'POST',
    //     data: {"idabo": idabo,"iduser": iduser},
    //     success: function (data) {
    //         aboclient = data['client'][0]['abonnement'];
    //         $("#aboselect").empty();
    //         $("#aboselect").append('<?php foreach($abonnements as $abonnement):?> <option value="<?php echo $abonnement['numAbo'];?>"><?php echo $abonnement['nomAbo']; ?></option> <?php endforeach;?>')
    //         $('#aboselect option[value="'+aboclient+'"]').prop('selected', true);
    //         $('.info').append('Abonnement mise à jour');
    //     },
    //     error: function (data) {
    //         console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
    //     }
    // });
}


function login() {
    $.ajax({
        url: '/Userscontroller/login',
        type: 'POST',
        data: {"emailC": $('.loginForm input[name=login_username]').val(),"motdepasseC": $('.loginForm input[name=login_password]').val()},
        success: function (data) {
            if(data["isUserLoggedIn"]) {
                $('#blocUser').empty().append("<div class='middlehor text-center' id='btnAccount'><div class='col-lg-12'>Bonjour "+data["prenom"]+" !</div><div><a href='users/account'><button class='col-lg-12 btn btn-primary'>Mon compte</button></a></div><button id='logout' class='col-lg-12 middlehor btn btn-primary'>Se deconnecter</button></div>");
                $('#logout').click(function() {
                        logout();
                    });
                $('#popinLogin').modal('hide')
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
            $('#account').empty().append("<input type='text' name='email' placeholder='Email'><br><input type='text' name='motdepasse' placeholder='Mot de passe'><br><button id='login' onclick='login()' class='btn btn-primary'>Se connecter</button><br><a class='btn btn-primary' href='users/registration' role='button'>Créer un compte</a>");

            location.assign("http://deeveadee.my");
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