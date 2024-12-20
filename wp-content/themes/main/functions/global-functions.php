<?php

function get_ID_by_slug( $page_slug ) {
    $page = get_page_by_path( $page_slug );
    if ( $page ) {
        return $page->ID;
    } else {
        return null;
    }
}


function theme_uri() {
    return get_template_directory_uri();
}


function echoif( $condition, $true, $false = '' ) {
    echo $condition ? $true : $false;
}


function itd_body_id() {
    global $post;
    $body_id = '';

    if ( is_front_page() ) {
        $body_id = 'home';

    } else if ( is_page() || is_single() ) {
        $body_id = $post->post_name;
    } else if (is_404()) {
        $body_id = 'not-found';
    }

    echo "class='{$body_id} {$post->post_type}'";
}

function add_slug_body_class() {
    global $post;
    return $post->post_name;
}
add_filter( 'body_class', 'add_slug_body_class' );
