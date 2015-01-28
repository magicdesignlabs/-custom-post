<?php
/*
 * Plugin Name: MDl Custom Post
 * Plugin URI: https://github.com/magicdesignlabs/-custom-post
 * Description: This is tutorial of creating custom-post in wordpress with it's setting page. 
 * Author:MDL
 * Author URI:http://magicdesignlabs.com/
 * Version: 0.1
*/

/********* START CUSTOM POST ***************/

add_action( 'init', 'cp_init' );

function cp_init() {
		$labels = array(
		'name'               => _x( 'Custom Post', 'post type general name', 'mdl-cp' ),
		'singular_name'      => _x( 'Custom Post', 'post type singular name', 'mdl-cp' ),
		'menu_name'          => _x( 'Custom Post', 'admin menu', 'mdl-cp' ),
		'name_admin_bar'     => _x( 'Custom Post', 'add new on admin bar', 'mdl-cp' ),
		'add_new'            => _x( 'Add New', 'custom-post', 'mdl-cp' ),
		'add_new_item'       => __( 'Add New Custom Post', 'mdl-cp' ),
		'new_item'           => __( 'New Custom Post', 'mdl-cp' ),
		'edit_item'          => __( 'Edit Custom Post', 'mdl-cp' ),
		'view_item'          => __( 'View Custom Post', 'mdl-cp' ),
		'all_items'          => __( 'All Custom Post', 'mdl-cp' ),
		'search_items'       => __( 'Search Custom Post', 'mdl-cp' ),
		'parent_item_colon'  => __( 'Parent Custom Post:', 'mdl-cp' ),
		'not_found'          => __( 'No Custom Post found.', 'mdl-cp' ),
		'not_found_in_trash' => __( 'No Custom Post found in Trash.', 'mdl-cp' )
	);

	$args = array(
		'labels'             => $labels,
		'taxonomies' => array('category'),//Add taxanomy Category
		'public'             => true, // if you want private custom-post, then make it false.
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'custom_post', 'with_front' => true ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true, //true- if want category else false
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
	);

	register_post_type( 'custom_post', $args );
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Types', 'taxonomy general name' ),
		'singular_name'     => _x( 'Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Types' ),
		'all_items'         => __( 'All Types' ),
		'parent_item'       => __( 'Parent Type' ),
		'parent_item_colon' => __( 'Parent Type:' ),
		'edit_item'         => __( 'Edit Type' ),
		'update_item'       => __( 'Update Type' ),
		'add_new_item'      => __( 'Add New Type' ),
		'new_item_name'     => __( 'New Type Name' ),
		'menu_name'         => __( 'Type' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'type', 'with_front' => true ),
	);

	register_taxonomy( 'type', array( 'custom_post' ), $args );

	add_action( 'add_meta_boxes', 'add_news_meta' );
	add_action('admin_menu' , 'mdl_custom_post_pages');

}



//Adding setting page
function mdl_custom_post_pages() {
add_submenu_page('edit.php?post_type=custom_post', 'View Setting', 'Settings', 'administrator', basename(__FILE__), 'custom_post_setting');
}

function custom_post_setting(){
	require_once "custom_post-setting.php";

}

function add_news_meta(){

	add_meta_box(   'custom_post-subheading', __('News Sub-heading'),  'custom_post_subheading', 'custom_post', 'normal', 'high');

}

//Adding Meta field
function custom_post_subheading($post) {
    $subheading = get_post_meta($post->ID, '_subheading', TRUE);
    if (!$subheading) $subheading = '';
    ?>
		<label>Sub-heading</label>
		 <input type="text"  name="_subheading" id="subheading" value="<?php echo $subheading;?>" />
		<br>
		<p>Sub-heading of Post.</p>


    <?php
}


/*****Save Meta Field********/
add_action('save_post', 'save_custom_post_data' );

function save_custom_post_data($post_id) {


    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    if ( !current_user_can( 'edit_post', $post_id ) )
          return $post_id;


    $mypost = get_post($post_id);

    if ($mypost->post_type == 'custom_post') {
		if(isset($_POST['_subheading']))
        update_post_meta($post_id, '_subheading', esc_attr($_POST['_subheading']) );
	}

    return $post_id;
}
/*****Save Meta Field********/

/********* END  CUSTOM POST ***************/