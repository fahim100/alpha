<?php

define( 'ATTACHMENTS_SETTINGS_SCREEN', false );
add_filter( 'attachments_default_instance', '__return_false' );

function alpha_attachments( $attachments ) {
    $fields = array(
        array(
            'name'      => 'title',
            'type'      => 'text',
            'label'     => __( 'Title', 'attachments' ),
            'default'   => 'title', 
        )
    );

    $args = array(
        'label'         => 'Featured Slider',
        'post_type'     => array( 'post' ),
        'button_text'   => __( 'Attach Files', 'attachments' ),
        'fields'        => $fields,
    );

    $attachments -> register( 'slider', $args );

}

add_action( 'attachments_register', 'alpha_attachments' );