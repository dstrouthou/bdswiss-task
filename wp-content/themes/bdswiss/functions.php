<?php
function fxstreet_sctipts_init() {
    wp_enqueue_style('fxstreet_style', get_template_directory_uri() . '/style.css', '', '1.2.1');
}
add_action('wp_enqueue_scripts', 'fxstreet_sctipts_init');