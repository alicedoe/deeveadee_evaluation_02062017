$( document ).ready(function() {
    $('#logout,#login').click(function() {
        $action = $(this).attr('id');
        window[$action]();
        });

});

function login() {
    $.ajax({
        url: '/Userscontroller/login',
        type: 'POST',
        data: {"emailC": "ayoxenr3@tripadvisor.com","motdepasseC": "dGlcpa6O"},
        success: function (data) {
            if(data["isUserLoggedIn"]) {
                prenom = data['prenom'];
                $('#account').empty().append('Bonjour '+prenom+' !<br><button id="logout" onclick="logout()" class="btn btn-primary">Se deconnecter</button><br><a class="btn btn-primary" href="users/account" role="button">Voir mon compte</a>');

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