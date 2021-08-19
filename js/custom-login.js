// ----------------------------------------------------
// Adding the placeholders in textfields of login/register/lost password form 
// ----------------------------------------------------


jQuery(document).ready(function($) {

    placeholder_login = $('#loginform label[for="user_login"], #lostpasswordform label[for="user_login"]').text();
    placeholder_password = $('#loginform label[for="user_pass"]').text();

	$('#loginform input[id="user_login"], #lostpasswordform input[id="user_login"]').prop('placeholder', placeholder_login);
	$('#loginform input[type="password"]').prop('placeholder', placeholder_password);

});


jQuery(document).ready(function($) {

	$('#registerform input[id="user_login"]').prop('placeholder', 'Wprowadź nazwę użytkownika');
    $('#registerform input[id="user_email"]').prop('placeholder', 'Wprowadź adres e-mail');

});

// ----------------------------------------------------
// Disabled submit button in register form, when terms is not checked. 
// ----------------------------------------------------

jQuery(document).ready(function($) {

	$('#registerform input[type="submit"]').prop('disabled', true);
    $('#terms').change(function(){
        if(this.checked)
            $('#registerform input[type="submit"]').prop('disabled', false);
        else
        $('#registerform input[type="submit"]').prop('disabled', true);
    });

});