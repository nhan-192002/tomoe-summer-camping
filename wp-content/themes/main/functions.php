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

    $nonce = wp_create_nonce('crf_register_action');
    ?>

    <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post" id="crf-registration-form">
        <input type="hidden" name="crf_nonce" value="<?php echo $nonce; ?>">
        <input type="text" required name="fullname" placeholder="Họ và tên" required>
        <input type="number" required name="age" placeholder="Tuổi của bé" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" required name="phone" placeholder="Số điện thoại" required>
        <input type="submit" name="crf_submit" value="Gửi">
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode( 'custom_registration_form', 'crf_register_form_shortcode' );

function crf_handle_form_submission() {
    if ( isset( $_POST['crf_submit'] ) ) {
        if ( !session_id() ) {
            session_start();
        }

        if ( !isset( $_POST['crf_nonce'] ) || !wp_verify_nonce( $_POST['crf_nonce'], 'crf_register_action' ) ) {
            $_SESSION['crf_success_message'] = 'Xác thực thất bại!';
            return;
        }

        if ( !empty( $_POST['honeypot'] ) ) {
            $_SESSION['crf_success_message'] = 'Có dấu hiệu spam!';
            return;
        }

        $current_time = time();
        if ( isset($_SESSION['last_submit_time']) && ($current_time - $_SESSION['last_submit_time']) < 10 ) {
            $_SESSION['crf_success_message'] = 'Bạn đang gửi quá nhanh, vui lòng chờ!';
            return;
        }
        $_SESSION['last_submit_time'] = $current_time;

        // ✅ Lấy dữ liệu từ form
        $name  = sanitize_text_field( $_POST['fullname'] );
        $age   = intval( $_POST['age'] );
        $email = sanitize_email( $_POST['email'] );
        $phone = sanitize_text_field( $_POST['phone'] );

        if ( empty( $name ) || empty( $age ) || empty( $email ) || empty( $phone ) ) {
            $_SESSION['crf_success_message'] = 'Vui lòng nhập đầy đủ thông tin!';
            return;
        }

        if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            $_SESSION['crf_success_message'] = 'Email không hợp lệ!';
            return;
        }

        // 📝 Tạo bài post
        $post_data = array(
            'post_title'   => 'Có một đăng ký trại hè mới từ người dùng có tên '.$name,
            'post_status'  => 'private',
            'post_type'    => 'post',
        );

        $post_id = wp_insert_post( $post_data );

        if ( $post_id ) {
            update_field( 'fullname', $name, $post_id );
            update_field( 'age', $age, $post_id );
            update_field( 'email', $email, $post_id );
            update_field( 'phone', $phone, $post_id );

            $_SESSION['crf_success_message'] = 'Đăng ký thành công!';
        } else {
            $_SESSION['crf_success_message'] = 'Đăng ký thất bại!';
        }

        // 🔄 Redirect để tránh gửi lại form khi F5
        wp_redirect( esc_url( $_SERVER['REQUEST_URI'] ) );
        exit;
    }
}
add_action( 'init', 'crf_handle_form_submission' );
