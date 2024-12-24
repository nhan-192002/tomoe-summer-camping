<?php
include "functions/global-functions.php";
include "functions/acf-option-page.php";

// Allow SVG
add_filter(
    'upload_mimes',
    function ( $upload_mimes ) {
        if ( ! current_user_can( 'administrator' ) ) {
            return $upload_mimes;
        }
        $upload_mimes['svg']  = 'image/svg+xml';
        $upload_mimes['svgz'] = 'image/svg+xml';
        return $upload_mimes;
    }
);
add_filter(
    'wp_check_filetype_and_ext',
    function ( $wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime ) {
        if ( ! $wp_check_filetype_and_ext['type'] ) {
            $check_filetype  = wp_check_filetype( $filename, $mimes );
            $ext             = $check_filetype['ext'];
            $type            = $check_filetype['type'];
            $proper_filename = $filename;
            if ( $type && 0 === strpos( $type, 'image/' ) && 'svg' !== $ext ) {
                $ext  = false;
                $type = false;
            }
            $wp_check_filetype_and_ext = compact( 'ext', 'type', 'proper_filename' );
        }
        return $wp_check_filetype_and_ext;
    },
    10,
    5
);

// Add menu
function register_my_menu() {
    register_nav_menus( array(
        'header_navigation' => 'Header Navigation',
    ) );
}
add_action('after_setup_theme', 'register_my_menu');

// Create a custom table for form data.
function crf_create_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_registration';
    $charset_collate = $wpdb->get_charset_collate();

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = 'CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            age int NOT NULL,
            email varchar(255) NOT NULL,
            phone varchar(20) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;';

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}
add_action('after_setup_theme', 'crf_create_table');

function crf_start_session() {
    if ( !session_id() ) {
        session_start();
    }
}
add_action( 'init', 'crf_start_session', 1 );

// Handle form submission.
function crf_handle_form_submission() {
    if ( isset( $_POST['crf_submit'] ) ) {
        global $wpdb;

        if ( !session_id() ) {
            session_start();
        }

        // Sanitize user input.
        $name   = sanitize_text_field( $_POST['name'] );
        $age    = intval( $_POST['age'] );
        $email  = sanitize_email( $_POST['email'] );
        $phone  = sanitize_text_field( $_POST['phone'] );

        // Insert data into the custom table.
        $table_name = $wpdb->prefix . 'custom_registration';
        $wpdb->insert(
            $table_name,
            [
                'name'   => $name,
                'age'    => $age,
                'email'  => $email,
                'phone'  => $phone,
            ],
            [
                '%s',
                '%d',
                '%s',
                '%s',
            ]
        );

        $_SESSION['crf_success_message'] = 'Đăng ký thành công!';
        wp_redirect( home_url('/#register') );
        exit();
    }
}
add_action( 'init', 'crf_handle_form_submission' );

function crf_register_form_shortcode() {
    if ( !session_id() ) {
        session_start();
    }
    ob_start();
    // Display success message if available in session.
    if ( isset( $_SESSION['crf_success_message'] ) ) {
        echo '<p class="success-message text-success">' . $_SESSION['crf_success_message'] . '</p>';

        // Optionally, you can clear the message after displaying it once.
        unset( $_SESSION['crf_success_message'] );
    }
    ?>

    <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post" id="crf-registration-form">
        <input type="text" name="name" placeholder="Họ và tên" required>
        <input type="number" name="age" placeholder="Tuổi của bé" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" name="phone" placeholder="Số điện thoại" required>
        <input type="submit" name="crf_submit" value="Gửi">
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode( 'custom_registration_form', 'crf_register_form_shortcode' );


