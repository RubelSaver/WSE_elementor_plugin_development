<?php


function WseChildTheme(){


        // Enqueue Slick CSS file with version number
        wp_enqueue_style('Wse_child_slick_style', get_template_directory_uri() . '/assets/css/slick.css', array(), '');

        // Child them main style
        wp_enqueue_style('Wse_child_style', get_stylesheet_uri());


        // Enqueue Slick Js file with jQuery as a dependency
        wp_enqueue_script('Wse_child_slick_js', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '', true);

}

add_action('wp_enqueue_scripts', 'WseChildTheme', PHP_INT_MAX);




if (in_array('elementor/elementor.php', get_option('active_plugins'))) {
    // Elementor is active
    // Your code here for when Elementor is active
    require_once('elementor-addons/addons.php'); 
} else {
    // Add admin notice
    function my_custom_admin_notice() {
        $message = 'This theme requires Elementor to be installed.';
        echo '<div class="notice notice-warning is-dismissible"><p>' . $message . '</p></div>';
    }
    add_action('admin_notices', 'my_custom_admin_notice');
}



/**
 * Wse_Team_Members Post Type register Custom post
 */

 if( ! class_exists( 'Wse_Team_Members' ) ) :
    class Wse_Team_Members {
        public static $post_type 		= 'Team Member';
        public static $menu_position	= 7;
        public static $taxonomy 		= 'Team_Member_category';
    
        public static function register() {
     
            // Title
            $labels = array(
                'name'					=> esc_html__( 'Team Members', 'elementor-addon' ),
                'singular_name'			=> esc_html__( 'Team_Member', 'elementor-addon' ),
                'add_new'				=> esc_html__( 'Add New', 'elementor-addon' ),
                'add_new_item'			=> esc_html__( 'Add New pricing', 'elementor-addon' ),
                'edit_item'				=> esc_html__( 'Edit pricing', 'elementor-addon' ),
                'new_item'				=> esc_html__( 'New pricing', 'elementor-addon' ),
                'view_item'				=> esc_html__( 'View pricing', 'elementor-addon' ),
                'search_items'			=> esc_html__( 'Search pricing', 'elementor-addon' ),
                'not_found'				=> esc_html__( 'No pricing found', 'elementor-addon' ),
                'not_found_in_trash'	=> esc_html__( 'No pricing found in trash', 'elementor-addon' ),
                'parent_item_color'		=> '',
                'menu_name'				=> esc_html__( 'Team Member', 'elementor-addon' )
            );
    
            // Options
            $args = array(
                'labels'				=> $labels,
                'public'				=> false,
                'public_queryable'		=> true,
                'show_ui'				=> true,
                'show_in_menu'			=> true,
                'query_var'				=> true,
                'rewrite'				=> array( 'slug' => self::$post_type ),
                'capability_type'		=> 'post',
                'has_archive'			=> false,
                'hierarchical'			=> false,
                'menu_position'			=> self::$menu_position,
                'menu_icon'				=> 'dashicons-welcome-learn-more',
                'supports'				=> array( 'title', 'editor', 'thumbnail'),
            );
    
            $labels = apply_filters( 'presscore_post_type_' . self::$post_type . '_labels', $labels );
            $args = apply_filters( 'presscore_post_type_' . self::$post_type . '_args', $args );
    
            register_post_type( self::$post_type, $args );
            flush_rewrite_rules();
    
            /* setup taxonomy */
    
            // titles
            $texanomy_labels = array(
                'name'             => esc_html__( 'Team_Member Categories',        'elementor-addon' ),
                'singular_name'    => esc_html__( 'Team_Member Category',          'elementor-addon' ),
                'all_items'        => esc_html__( 'Team_Member Categories',        'elementor-addon' ),
                'parent_item'      => esc_html__( 'Parent Team_Member Category',   'elementor-addon' ),
                'parent_item_colon'=> esc_html__( 'Parent Team_Member Category:',  'elementor-addon' ),
                'edit_item'        => esc_html__( 'Edit Category',             'elementor-addon' ), 
                'update_item'      => esc_html__( 'Update Category',           'elementor-addon' ),
                'add_new_item'     => esc_html__( 'Add New Team_Member Category',  'elementor-addon' ),
                'new_item_name'    => esc_html__( 'New Team_Member Name',          'elementor-addon' ),
                'menu_name'        => esc_html__( 'Team_Member Categories',        'elementor-addon' )
            );
    
            $taxonomy_args = array(
                'hierarchical'          => true,
                'public'                => true,
                'labels'                => $texanomy_labels,
                'show_ui'               => true,
                'rewrite'               => array('slug' => 'Team_Member_category'),
                'show_admin_column'	=> true,
            );
    
            $taxonomy_args = apply_filters( 'presscore_taxonomy_' . self::$taxonomy . '_args', $taxonomy_args );
    
            register_taxonomy( self::$taxonomy, array( self::$post_type ), $taxonomy_args );
    
        }
    }
    endif;
    
    if( ! function_exists( 'Wse_Team_Members' ) ) :
        function Wse_Team_Members() {
            Wse_Team_Members::register();
        }
    endif;
    add_action( 'init', 'Wse_Team_Members', 10 );




//add shortcode

function wse_team_shortcode() {
		$TeamMemberPost = new WP_Query([
			'post_type' => 'Team Member',
			'posts_per_page' => -1,
	]);

    $html = '';

    while($TeamMemberPost->have_posts()) {
        $TeamMemberPost->the_post();
        $html .=  '<h2>' . get_the_title() . '</h2>';

    }
    wp_reset_query();

    return $html;
}

add_shortcode('teamMemberShortCode', 'wse_team_shortcode');









