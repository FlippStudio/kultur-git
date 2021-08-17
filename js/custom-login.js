// ----------------------------------------------------
// Adding the placeholders in textfields of login form 
// ----------------------------------------------------


jQuery(document).ready(function($) {

    placeholder_login = $('#loginform label[for="user_login"]').text();
    placeholder_password = $('#loginform label[for="user_pass"]').text();

	$('#loginform input[id="user_login"]').prop('placeholder', placeholder_login);
	$('#loginform input[type="password"]').prop('placeholder', placeholder_password);

});


jQuery(document).ready(function($) {

    placeholder_login = $('#registerform label[for="user_login"]').text();
    placeholder_email= $('#registerform label[for="user_email"]').text();

	$('#registerform input[id="user_login"]').prop('placeholder', placeholder_login);
    $('#registerform input[id="user_email"]').prop('placeholder', placeholder_email);

});

jQuery(document).ready(function($) {

	$('#registerform input[type="submit"]').prop('disabled', true);
    $('#terms').change(function(){
        if(this.checked)
            $('#registerform input[type="submit"]').prop('disabled', false);
        else
        $('#registerform input[type="submit"]').prop('disabled', true);
    });

});