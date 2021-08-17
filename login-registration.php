<?php

function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/custom-login.css' );
    wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.6.0.slim.min.js' );
    wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/js/custom-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg);
		height:65px;
		width:320px;
		background-size: 320px 65px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <table class="form-table">
    <tr>
        <th><label for="date_birth"><?php _e("Data urodzenia"); ?></label></th>
        <td>
            <input type="date" name="date_birth" id="date_birth" value="<?php echo esc_attr( get_the_author_meta( 'date_birth', $user->ID ) ); ?>" class="regular-text" disabled />
        </td>
    </tr>
    <tr>
        <th><label for="type"><?php _e("Typ użytkownika:"); ?></label></th>
        <td>
            <input type="text" name="type" id="type" value="<?php if(esc_attr( get_the_author_meta( 'type', $user->ID ) ) == ''): echo ''; elseif(esc_attr( get_the_author_meta( 'type', $user->ID ) ) == 'N'): echo 'Jestem osobą niepełnosprawną.'; else: echo 'Jestem potencjalnym opiekunem.'; endif; ?>" class="regular-text" disabled /><br />
        </td>
    </tr>
    <tr>
    <th><label for="gender"><?php _e("Płeć"); ?></label></th>
        <td>
            <select name="gender" id="gender" class="regular-text">
                <option value="" readonly>Wybierz płeć</option>
                <option value="M" <?php if(esc_attr( get_the_author_meta( 'gender', $user->ID ) ) == 'M'): echo 'selected'; endif; ?>>Mężczyzna</option>
                <option value="K" <?php if(esc_attr( get_the_author_meta( 'gender', $user->ID ) ) == 'K'): echo 'selected'; endif; ?>>Kobieta</option>
            </select><br>
            <span class="description"><?php _e("Proszę wybrać swoją płeć."); ?></span>
        </td>
    </tr>
    </table>
<?php }


add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
        return;
    }
    
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'gender', $_POST['gender'] );
}



add_action( 'register_form', 'myplugin_register_form' );
function myplugin_register_form() {

    $first_name = ( ! empty( $_POST['first_name'] ) ) ? trim( $_POST['first_name'] ) : '';
    $last_name = ( ! empty( $_POST['last_name'] ) ) ? trim( $_POST['last_name'] ) : '';

        ?>
        <p>
            <label for="first_name"><?php _e( 'Imię') ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="30" placeholder="Wprowadź imię" />
            </label>
        </p>

        <p>
            <label for="last_name"><?php _e( 'Nazwisko') ?><br />
                <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr( wp_unslash( $last_name ) ); ?>" size="50" placeholder="Wprowadź nazwisko" />
            </label>
        </p>
        <p>
            <label for="date_birth"><?php _e( 'Data urodzenia') ?><br />
                <input type="date" name="date_birth" id="date_birth" class="input" placeholder="Wprowadź datę urodzenia" />
            </label>
        </p>
        <p>
            <label for="type" class="mb-3"><?php _e( 'Typ użytkownika:') ?><br />
                <select name="type" id="type">
                    <option value="N">Jestem osobą niepełnosprawną</option>
                    <option value="O">Jestem potencjalnym opiekunem</option>
                </select>
            </label>
        </p>
        <p>
            <label for="terms" class="mb-3">
                <input type="checkbox" name="terms" id="terms" class="float-left mr-3"/>
                Akceptuję <a href="<?php echo wp_get_attachment_url(79); ?>" target="_blank" rel="noopener noreferrer">Regulamin</a>, 
                <a href="<?php echo wp_get_attachment_url(80); ?>" target="_blank" rel="noopener noreferrer">politykę prywatności</a>, <a href="<?php echo wp_get_attachment_url(82); ?>" target="_blank" rel="noopener noreferrer">politykę Cookies</a> oraz 
                <a href="<?php echo wp_get_attachment_url(); ?>" target="_blank" rel="noopener noreferrer">zasady RODO.</a>
            </label>        
        </p>

        <?php
    }

    //2. Add validation. In this case, we make sure first_name and last_name is required.
    add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
    function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {

        if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
            $errors->add( 'first_name_error', __( '<strong>Błąd</strong>: Należy podać imię.', 'mydomain' ) );
        }
        if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
            $errors->add( 'last_name_error', __( '<strong>Błąd</strong>: Należy podać nazwisko.', 'mydomain' ) );
        }
        if ( empty( $_POST['date_birth'] ) || ! empty( $_POST['date_birth'] ) && trim( $_POST['date_birth'] ) == '' ) {
            $errors->add( 'date_birth_error', __( '<strong>Błąd</strong>: Należy wprowadzić datę urodzenia.', 'mydomain' ) );
        }
        return $errors;
    }

    //3. Finally, save our extra registration user meta.
    add_action( 'user_register', 'myplugin_user_register' );
    function myplugin_user_register( $user_id ) {
        if ( ! empty( $_POST['first_name'] ) ) {
            update_user_meta( $user_id, 'first_name', trim( $_POST['first_name'] ) );
            update_user_meta( $user_id, 'last_name', trim( $_POST['last_name'] ) );
            update_user_meta( $user_id, 'date_birth', trim( $_POST['date_birth'] ) );
            update_user_meta( $user_id, 'type', trim( $_POST['type'] ) );
        }
    }

?>