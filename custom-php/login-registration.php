<?php

// ----------------------------------------------------
// Attach custom css & js files for login/register/lostpassword site.
// ----------------------------------------------------
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/custom-login.css' );
    wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.6.0.slim.min.js' );
    wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/js/custom-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

// ----------------------------------------------------
// Changed images on login/register/lostpassword site.
// ----------------------------------------------------
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg);height:65px;width:320px;background-size: 320px 65px;background-repeat: no-repeat;}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


add_filter( 'login_headerurl', 'custom_loginlogo_url' );

function custom_loginlogo_url($url) {

     return 'https://kulturlove.pl/';

}


// ----------------------------------------------------
// Adding extra fields to user profile for correctly portal working.
// ----------------------------------------------------
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
    <tr>
    <!--<th><label for="user_phone"><?php _e("Nr telefonu"); ?></label></th>
        <td>
            <input type="tel" name="user_phone" id="user_phone" value="<?php echo esc_attr( get_the_author_meta( 'user_phone', $user->ID ) ); ?>" class="regular-text" pattern="[0-9]{9}" size="9" placeholder="Wprowadź nr telefonu" /><br>
            <span class="description"><?php _e("Proszę wprowadzić swój nr telefonu."); ?></span>
        </td>
    </tr>-->
    </table>
<?php }


/*
add_filter( 'user_profile_update_errors', 'myplugin_edit_user_errors', 10, 3 );
function myplugin_edit_user_errors($errors){
    $re = '/^\d{9}$/';
    if ( !empty( $_POST['user_phone'] ) || ! empty( $_POST['user_phone'] ) && trim( $_POST['user_phone'] ) != '' ) {
        preg_match_all($re, $_POST['user_phone'], $matches, PREG_SET_ORDER, 0);
        if(empty($matches)): 
            $errors->add( 'user_phone_error', __( '<strong>Błąd</strong>: Nr telefonu powinniem składać się z 9 cyfr.') );
        endif;
    }
    
}
*/
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
        return;
    }
    
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    
    if ( ! empty( $_POST['gender'] ) ) {
        update_user_meta( $user_id, 'gender', trim( $_POST['gender'] ) );
    }

    /*if ( ! empty( $_POST['user_phone'] ) ) {
        update_user_meta( $user_id, 'user_phone', trim( $_POST['user_phone'] ) );
    } */
    
}


add_action( 'register_form', 'myplugin_register_form' );
function myplugin_register_form() {

    $first_name = ( ! empty( $_POST['first_name'] ) ) ? trim( $_POST['first_name'] ) : '';
    $last_name = ( ! empty( $_POST['last_name'] ) ) ? trim( $_POST['last_name'] ) : '';
    $date_birth = ( ! empty( $_POST['date_birth'] ) ) ? trim( $_POST['date_birth'] ) : '';
    $type = ( ! empty( $_POST['type'] ) ) ? trim( $_POST['type'] ) : ''; 
    
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
                <input type="date" name="date_birth" id="date_birth" class="input" value="<?php echo esc_attr( wp_unslash( $date_birth ) ); ?>" placeholder="dd-mm-yyyy" min="1921-01-01" max="<?php echo date('Y-m-d'); ?>" />
            </label>
        </p>
        <p>
            <label for="type" class="mb-3"><?php _e( 'Typ użytkownika:') ?><br />
                <select name="type" id="type">
                    <option value="N">Jestem osobą niepełnosprawną</option>
                    <option value="O" <?php if(esc_attr( wp_unslash( $type ) ) == 'O'): echo 'selected'; endif; ?>>Jestem potencjalnym opiekunem</option>
                </select>
            </label>
        </p>
        <p>
            <label for="terms" class="mb-3">
                <input type="checkbox" name="terms" id="terms" class="float-left mr-3"/>
                Akceptuję <a href="<?php echo wp_get_attachment_url(79); ?>" target="_blank" rel="noopener noreferrer">Regulamin</a>, 
                <a href="<?php echo wp_get_attachment_url(80); ?>" target="_blank" rel="noopener noreferrer">politykę prywatności</a> oraz <a href="<?php echo wp_get_attachment_url(82); ?>" target="_blank" rel="noopener noreferrer">politykę Cookies.</a>
            </label>   
        </p>

        <?php
    }

    //2. Add validation. In this case, we make sure first_name and last_name is required.
    add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
    function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {
        $re = '/[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžśÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.\'-]+$/';
        
        if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
            $errors->add( 'first_name_error', __( '<strong>Błąd</strong>: Należy podać imię.') );
        }else{
            preg_match_all($re, $_POST['first_name'], $matches, PREG_SET_ORDER, 0);
            if(empty($matches)): 
                $errors->add( 'first_name_error', __( '<strong>Błąd</strong>: Imię powinno się składać wyłącznie z liter.') );
            endif;
        }
        if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
            $errors->add( 'last_name_error', __( '<strong>Błąd</strong>: Należy podać nazwisko.') );
        }else{
            preg_match_all($re, $_POST['last_name'], $matches, PREG_SET_ORDER, 0);
            if(empty($matches)): 
                $errors->add( 'last_name_error', __( '<strong>Błąd</strong>: Nazwisko nie powinno zawierać cyfr i znaków specjalnych.') );
            endif;
        }
        if ( empty( $_POST['date_birth'] ) || ! empty( $_POST['date_birth'] ) && trim( $_POST['date_birth'] ) == '' ) {
            $errors->add( 'date_birth_error', __( '<strong>Błąd</strong>: Należy wprowadzić datę urodzenia. ') );
        }else{
            $date = $_POST['date_birth']; $date = str_replace('-', '', $date);
            $year = (int)substr($date, 0, 4); $month = (int)substr($date, 4, 2);$day = (int)substr($date, 6, 2);
            
            if( ( $year > (int)date('Y') ) || ( $year == (int)date('Y') && $month > (int)date('m') ) || ( $year == (int)date('Y') && $month == (int)date('m') && $day > (int)date('d') ) ):
                $errors->add( 'date_birth_error', __( '<strong>Błąd</strong>: Data urodzenia późniejsza od daty dzisiejszej.' ) );
            endif;
        }
        return $errors;
    }

    //3. Finally, save our extra registration user meta.
    add_action( 'user_register', 'myplugin_user_register' );
    function myplugin_user_register( $user_id ) {
        if ( ! empty( $_POST['first_name'] ) ) {
            update_user_meta( $user_id, 'first_name', trim( $_POST['first_name'] ) );
        }
        if ( ! empty( $_POST['last_name'] ) ) {
            update_user_meta( $user_id, 'last_name', trim( $_POST['last_name'] ) );
        }
        if ( ! empty( $_POST['date_birth'] ) ) {
            update_user_meta( $user_id, 'date_birth', trim( $_POST['date_birth'] ) );
        }
        if ( ! empty( $_POST['type'] ) ) {
            update_user_meta( $user_id, 'type', trim( $_POST['type'] ) );
        }        

    }

?>