<?php
function parseAndLoad ($feedUrl, $feedName)
{

    $xml = simplexml_load_file($feedUrl);
    if ($xml) {
        $itemsAmount = count($xml->channel->item);

        $aggregatedData = [];
        for ($i = 0; $i < $itemsAmount; $i++) {
            $value = (array)$xml->channel->item[$i];
            $aggregatedData[] = [
                'title' => $value['title'],
                'link' => $value['link'],
                'content' => $value['description'],
                'date_p' => $value['pubDate']
            ];
        }
        $taxonomyTitle = sanitize_title($feedName);
        $term = get_term_by('slug', $taxonomyTitle, 'feed_holder');
        $termId = 0;
        if (!empty($term)) {
            $termId = $term->term_id;
        } else {
            $termData = wp_insert_term($feedName, 'feed_holder', [
                'slug' => $taxonomyTitle,
                'parent' => 0
            ]);
            $termId = $termData['term_id'];
        }
        foreach ($aggregatedData as $value) {
            $feed = get_page_by_title($value['title'], ARRAY_A, 'feeds');
            if (!empty($feed)) {
                unset($feed);
                continue;
            }

            $id = wp_insert_post([
                'post_title' => $value['title'],
                'post_content' => $value['content'],
                'post_date' => $value['pubDate'],
                'post_status' => 'publish',
                'post_author' => 1,
                'post_type' => 'feeds',
                'tax_input' => ['feed_holder' => [$termId]]
            ]);

        }
    }

}
//add_shortcode('returnParsed', 'returnParsed');
add_action( 'init', 'register_post_types' );
function register_post_types(){
    register_taxonomy( 'feed_holder', [ 'feeds' ], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => [
            'name'              => 'Feed Holder',
            'singular_name'     => 'Feed Holder',
            'search_items'      => 'Feed Holders',
            'all_items'         => 'All Feed Holders',
            'view_item '        => 'View Feed Holder',
            'parent_item'       => 'Parent Feed Holder',
            'parent_item_colon' => 'Parent Feed Holders:',
            'edit_item'         => 'Edit Feed Holder',
            'update_item'       => 'Update Feed Holder',
            'add_new_item'      => 'Add New Feed Holder',
            'new_item_name'     => 'New Genre Feed Holder',
            'menu_name'         => 'Feed Holder',
        ],
        'description'           => 'Just a feed holders to split by shortcode',
        'public'                => true,
        'hierarchical'          => false,

        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => null,
        'show_admin_column'     => true,
        'show_in_rest'          => null,
        'rest_base'             => null,
    ] );
    register_post_type( 'feeds', [
        'label'  => null,
        'labels' => [
            'name'               => 'Feed',
            'singular_name'      => 'Feed',
            'add_new'            => 'Add feed',
            'add_new_item'       => 'Adding feed',
            'edit_item'          => 'Edit feed',
            'new_item'           => 'New feed',
            'view_item'          => 'Show feed',
            'search_items'       => 'Search feed',
            'not_found'          => 'Not found',
            'not_found_in_trash' => 'Not found in trash',
            'menu_name'          => 'Feeds',
        ],
        'description'         => '',
        'public'              => true,
        'show_in_menu'        => null,
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => null,
        'hierarchical'        => false,
        'supports'            => [ 'title', 'editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats' ],
        'taxonomies'          => [],
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ] );
    register_post_type('feedsrss', [
            'label' => 'Parsed Rss',
            'labels' => [
                'name'               => 'Feeds RSS',
                'singular_name'      => 'Feeds RSS',
                'add_new'            => 'Add Feeds RSS',
                'add_new_item'       => 'Adding Feeds RSS',
                'edit_item'          => 'Edit Feeds RSS',
                'new_item'           => 'New Feeds RSS',
                'view_item'          => 'Show Feeds RSS',
                'search_items'       => 'Search Feeds RSS',
                'not_found'          => 'Not Feeds RSS',
                'not_found_in_trash' => 'Not found in trash',
                'menu_name'          => 'Feeds RSS',
            ],
            'description'         => '',
            'public'              => true,
            'show_in_menu'        => null,
            'show_in_rest'        => null,
            'rest_base'           => null,
            'menu_position'       => null,
            'menu_icon'           => null,
            'hierarchical'        => false,
            'supports'            => [ 'title', 'custom-fields', 'revisions', 'post-formats' ],
            'taxonomies'          => [],
            'has_archive'         => false,
            'rewrite'             => true,
            'query_var'           => true,
        ]

    );

}
add_action( 'add_meta_boxes_feedsrss', 'meta_box_for_products' );
function meta_box_for_products( $post ){
    add_meta_box( 'my_meta_box_custom_id', __( 'Additional info', 'textdomain' ), 'my_custom_meta_box_html_output', 'feedsrss', 'normal', 'low' );
}

function my_custom_meta_box_html_output( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'my_custom_meta_box_nonce' ); //used later for security
    $feedUrl = get_post_meta($post->ID, 'import_feed_url', true);
    if (!isset($feedUrl) || empty($feedUrl)) {
        $feedUrl = '';
    }
    echo '<div><label for="is_this_featured">'.__('Feed Url:', 'textdomain').'</label><br><input type="text" name="import_feed_url" placeholder="https://www.forexlive.com/feed" value="' . $feedUrl . '" /></div>';
}

add_action( 'save_post_feedsrss', 'team_member_save_meta_boxes_data', 10, 2 );
function team_member_save_meta_boxes_data( $post_id ){
    // check for nonce to top xss
    if ( !isset( $_POST['my_custom_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['my_custom_meta_box_nonce'], basename( __FILE__ ) ) ){
        return;
    }

    // check for correct user capabilities - stop internal xss from customers
    if ( ! current_user_can( 'edit_post', $post_id ) ){
        return;
    }

    // update fields
    if ( isset( $_REQUEST['import_feed_url'] ) ) {
        update_post_meta( $post_id, 'import_feed_url', sanitize_text_field( $_POST['import_feed_url'] ) );
    }

    $feedUrl = get_post_meta($post_id, 'import_feed_url', true);
    if (isset($feedUrl) && !empty($feedUrl)) {
        parseAndLoad($feedUrl, $_POST['post_title']);
    }

}
function parsedFeedOutput($attrs) {
     $args = [
        'numberposts' => 5,
        'post_type' => 'feeds',
        'orderby' => 'date',
        'order' => 'DESC'
    ];
    if (isset($attrs['taxonomy'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'feed_holder',
                'field' => 'slug',
                'terms' => $attrs['taxonomy']
            ]
        ];
    }
    $posts = get_posts($args);
    ob_start();
    foreach ($posts as $item): ?>
    <div class="parsed-feed-holder">
        <h3><a href=""><?php echo $item->post_title; ?></a></h3>
<!--        <div class="parsed-feed-content-holder">--><?php //echo $item->post_content; ?><!--</div>-->
    </div>
    <?php endforeach;
    $ob_str=ob_get_contents();
    ob_end_clean();
    return $ob_str;
}
add_shortcode('parsedFeedOutput', 'parsedFeedOutput');