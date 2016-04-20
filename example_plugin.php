<?php 
/*
 * Plugin Name:OTC Media Plugin
 */
############################
# TAXONOMY PAGES
############################
global $wp_query;
$term = $wp_query->get_queried_object();
#industry/test/ is taxonomy-industry.php for industry taxonomy and test term


############################
# ADD VARS TO TAXONOMY PAGE
############################
			
global $wp_query; 
?>
<pre>
	<?php print_r($wp_query->query_vars); ?>
</pre>
<?php	
				
add_action('init','add_location_to_directory_cat');

function add_location_to_directory_cat() {
	global $wp,$wp_rewrite;
	$wp->add_query_var('directory_location');

	add_rewrite_rule(
		'directory-category/([^/]+)/location/([^/]+)?$',
		'index.php?directory_category=$matches[1]&directory_location=$matches[2]',
		'top'
		);

	add_rewrite_rule(
		'directory-category/([^/]+)/location/([^/]+)/page/([0-9]+)?$',
		'index.php?directory_category=$matches[1]&directory_location=$matches[2]&paged=$matches[3]',
		'top'
		);

}
/*in theme - $location = get_query_var('directory_location');
$location_slug  = get_query_var( 'directory_location' );
$directory_category_slug  = get_query_var( 'directory_category' );
$location = get_term_by( 'slug', $location_slug , 'location' );
	wp_reset_postdata();

				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				
				$args = array(
					'paged' => $paged, 
					'orderby'     => array( 'meta_value' => 'DESC' ),
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'directory_category',
							'field'    => 'slug',
							'terms'    => array($directory_category_slug),
							) , 
						array(
							'taxonomy' => 'location',
							'field'    => 'slug',
							'terms'    => array($location_slug),
							) , 
						), 
					'meta_query'  => array(
						'relation' => 'OR',
						array(
							'key'     => 'premium_listing',
							'compare' => 'NOT EXISTS',
							),
						array(
							'relation' => 'OR',
							array(
								'key'   => 'premium_listing',
								'value' => 'on',
								),
							array(
								'key'     => 'premium_listing',
								'value'   => 'on',
								'compare' => '!=',
								),
							),
						),
					
					); 

				$query = new WP_Query( $args );
*/
############################
# GET TERMS OF POST
############################
			
	//Returns title of locations
	$term_list = wp_get_post_terms($post->ID, 'location', array("fields" => "names"));
	echo $term_list[0];
									
############################
# GET POST CONTENT FROM ID
############################
$my_postid = 9120;//This is page id or post id
$content_post = get_post($my_postid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
echo  $content_post->post_title;

############################
# CMB DECLAREATION
############################
if ( ! defined( 'CMB_PATH') ) {
	include_once( plugin_dir_path( __FILE__ ) . '/cmb/custom-meta-boxes.php' );
}

############################
# Register Sidebar
############################
function _tk_widgets_init() {
	register_sidebar( array('name' => 'Search Bar', 'id' => 'search') );
}
add_action( 'widgets_init', '_tk_widgets_init' );

/*
<?php if ( is_active_sidebar( 'search' ) ) : ?>
	<?php dynamic_sidebar( 'search' ); ?>
<?php endif; ?> 
*/


###########################
//REGISTER POST TYPE AND TAXONOMY
###########################
add_action('init' , function() {
	/////////////////////////////////////////
	//News Post Type
	/////////////////////////////////////////
	$singular_name = '';
	$plural_name = '';
	$labels = array(
		'name'               => _x( "$singular_name", "post type general name", "wobble" ),
		"singular_name"      => _x( "$plural_name", "post type singular name", "wobble" ),
		"menu_name"          => _x( "$singular_name", "admin menu", "wobble" ),
		"name_admin_bar"     => _x( "$singular_name", "add new on admin bar", "wobble" ),
		"add_new"            => _x( "Add New", "$plural_name", "wobble" ),
		"add_new_item"       => __( "Add New $plural_name", "wobble" ),
		"new_item"           => __( "New $plural_name", "wobble" ),
		"edit_item"          => __( "Edit $plural_name", "wobble" ),
		"view_item"          => __( "View $plural_name", "wobble" ),
		"all_items"          => __( "All $singular_name", "wobble" ),
		"search_items"       => __( "Search $singular_name", "wobble" ),
		"parent_item_colon"  => __( "Parent $plural_name:", "wobble" ),
		"not_found"          => __( "No $singular_name found.", "wobble" ),
		"not_found_in_trash" => __( "No $singular_name found in Trash.", "wobble" )
		);

$args = array(
	'labels'             => $labels, 
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null, 
	'supports'           => array( 'title' , 'editor' , 'thumbnail'),
	'menu_icon'			 => 'dashicons-index-card'
	);

//	https://developer.wordpress.org/resource/dashicons/

register_post_type( 'service', $args ); 

$singular_name = '';
$plural_name = '';
$labels = array(
	'name'              => _x( "$plural_name", "taxonomy general name" ),
	"singular_name"     => _x( "$singular_name", "taxonomy singular name" ),
	"search_items"      => __( "Search $plural_name" ),
	"all_items"         => __( "All $plural_name" ),
	"parent_item"       => __( "Parent $singular_name" ),
	"parent_item_colon" => __( "Parent $singular_name:" ),
	"edit_item"         => __( "Edit $singular_name" ),
	"update_item"       => __( "Update $singular_name" ),
	"add_new_item"      => __( "Add New $singular_name" ),
	"new_item_name"     => __( "New $singular_name Name" ),
	"menu_name"         => __( "$singular_name" ),
	);

$args = array(
	'hierarchical'      => true,
	'labels'            => $labels,
	'show_ui'           => true,
	'show_admin_column' => true,
	'query_var'         => true,
	'rewrite'           => array( 'slug' => 'it-solutions' ),
	);

register_taxonomy( 'it_solution', 'service' ,  $args );

});

###########################
//CMB EXAMPLE
###########################
add_filter( 'cmb_meta_boxes', function(array $meta_boxes ) {

	// $fields = array(
	// 	array( 'id' => 'field-1',  'name' => 'Text input field', 'type' => 'text' ),
	// 	array( 'id' => 'field-2', 'name' => 'Read-only text input field', 'type' => 'text', 'readonly' => true, 'default' => 'READ ONLY' ),
 	// 	array( 'id' => 'field-3', 'name' => 'Repeatable text input field', 'type' => 'text', 'desc' => 'Add up to 5 fields.', 'repeatable' => true, 'repeatable_max' => 5, 'sortable' => true ),
	// 	array( 'id' => 'field-4',  'name' => 'Small text input field', 'type' => 'text_small' ),
	// 	array( 'id' => 'field-5',  'name' => 'URL field', 'type' => 'url' ),
	// 	array( 'id' => 'field-6',  'name' => 'Radio input field', 'type' => 'radio', 'options' => array( 'Option 1', 'Option 2' ) ),
	// 	array( 'id' => 'field-7',  'name' => 'Checkbox field', 'type' => 'checkbox' ),
	// 	array( 'id' => 'field-8',  'name' => 'WYSIWYG field', 'type' => 'wysiwyg', 'options' => array( 'editor_height' => '100' ), 'repeatable' => true, 'sortable' => true ),
	// 	array( 'id' => 'field-9',  'name' => 'Textarea field', 'type' => 'textarea' ),
	// 	array( 'id' => 'field-10',  'name' => 'Code textarea field', 'type' => 'textarea_code' ),
	// 	array( 'id' => 'field-11', 'name' => 'File field', 'type' => 'file', 'file_type' => 'image', 'repeatable' => 1, 'sortable' => 1 ),
	// 	array( 'id' => 'field-12', 'name' => 'Image upload field', 'type' => 'image', 'repeatable' => true, 'show_size' => true ),
	// 	array( 'id' => 'field-13', 'name' => 'Select field', 'type' => 'select', 'options' => array( 'option-1' => 'Option 1', 'option-2' => 'Option 2', 'option-3' => 'Option 3' ), 'allow_none' => true, 'sortable' => true, 'repeatable' => true ),
	// 	array( 'id' => 'field-14', 'name' => 'Select field', 'type' => 'select', 'options' => array( 'option-1' => 'Option 1', 'option-2' => 'Option 2', 'option-3' => 'Option 3' ), 'multiple' => true ),
	// 	array( 'id' => 'field-15', 'name' => 'Select taxonomy field', 'type' => 'taxonomy_select',  'taxonomy' => 'category' ),
	// 	array( 'id' => 'field-15b', 'name' => 'Select taxonomy field', 'type' => 'taxonomy_select',  'taxonomy' => 'category',  'multiple' => true ),
	// 	array( 'id' => 'field-16', 'name' => 'Post select field', 'type' => 'post_select', 'use_ajax' => false, 'query' => array( 'cat' => 1 ) ),
	// 	array( 'id' => 'field-17', 'name' => 'Post select field (AJAX)', 'type' => 'post_select', 'use_ajax' => true ),
	// 	array( 'id' => 'field-17b', 'name' => 'Post select field (AJAX)', 'type' => 'post_select', 'use_ajax' => true, 'query' => array( 'posts_per_page' => 8 ), 'multiple' => true  ),
	// 	array( 'id' => 'field-18', 'name' => 'Date input field', 'type' => 'date' ),
	// 	array( 'id' => 'field-19', 'name' => 'Time input field', 'type' => 'time' ),
	// 	array( 'id' => 'field-20', 'name' => 'Date (unix) input field', 'type' => 'date_unix' ),
	// 	array( 'id' => 'field-21', 'name' => 'Date & Time (unix) input field', 'type' => 'datetime_unix' ),
	// 	array( 'id' => 'field-22', 'name' => 'Color', 'type' => 'colorpicker' ),
	// 	array( 'id' => 'field-23', 'name' => 'Location', 'type' => 'gmap' ),
	// 	array( 'id' => 'field-24', 'name' => 'Title Field', 'type' => 'title' ),
	// );
	// 

	$fields = array(
		array( 'id' => 'test', 'name' => 'Text Fields', 'type' => 'text', 'repeatable' => true, 'sortable' => true ),
		);

	$meta_boxes[] = array(
		'title' => 'Options',
		'pages' => 'page',
        // 'show_on' => array( 'id' => array( 1 ) ),
        // 'hide_on' => array( 'page-template' => array( 'test-page-template.php' ) ),
		'context'    => 'normal',
		'priority'   => 'high',
        'fields' => $fields // an array of fields - see individual field documentation.
        );
return $meta_boxes; 
} );

###########################
//CUSTOMIZOR FIELDS
###########################

add_action( 'customize_register', function($wp_customize ) {
	$wp_customize->add_section( 'features_images' , array(
		'title'       => __( 'Custom Feature Images', 'dial' ),
		'priority'    => 30,
		) );
	$wp_customize->add_setting( 'default_banner' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'default_banner', array(
		'label'    => __( 'Default Site Banner Image', 'dial' ),
		'section'  => 'features_images',
		'settings' => 'default_banner',
		) ) );

	$wp_customize->add_section( 'contact-info' , array(
		'title' => __( 'General Information', '_tk' ),
		'priority' => 30
		) );

	$wp_customize->add_setting( 'phone' , array( 'default' => '' ));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'phone', array(
		'label' => __( 'Phone Number', '_tk' ),
		'section' => 'contact-info',
		'settings' => 'phone',
		) ) );

} );
get_theme_mod('phone' , '');


###########################
//SHORTCODE
###########################

//
add_shortcode('latest_news' , function($args) {
	ob_start();
	//http://scribu.net/wordpress/advanced-metadata-queries.html
	
	
	query_posts( array(
		'post_type' => 'listing',
		'showposts' => '-1' ,
		'tax_query' => array(
			array(
				'taxonomy' => 'product_category',
				'terms'    => array('cat1' , 'cat2'),
				)
			)
		)); 
	#$results = $GLOBALS['wpdb']->get_results( "SELECT * FROM wp_posts WHERE `post_type` ='checklist' AND `post_status` = 'publish'", OBJECT );
	
query_posts( array(
		'post_type' => 'listing',
		'showposts' => '-1' ,
		'orderby' => 'meta_value',
		'meta_key' => 'user_id',
		'meta_value' => '1',
		)); 
 		?>
		<div class="container">
		<div class="row">
				<?php $i = 0; ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="col-sm-6">
						<div class="background-img background-overlay" style="height:300px;background-image:url(<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id()) ); ?>);">
							<a href="it-solutions/<?php echo $term->slug ?>">
								<div style="height:100%;display:table;width:100%;">
									<h2 style="text-transform:uppercase;color:white;font-size:40px;width:100%;height:100%;vertical-align:middle;text-align:center;display:table-cell;">
										<?php the_title(); ?>
									</h2>
								</div>
							</a>
						</div>
					</div>
					<?php 	$i++;		
							if ($i%2 == 0) echo '</div><div class="row">';		
										?>
 				<?php endwhile; // end of the loop. ?>	
 				<?php wp_reset_query(); ?>
 			</div>	
 		</div>
 		<?php
		$temp = ob_get_contents();
		ob_end_clean();
		return $temp;
	});

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}
###########################
//CMB2 EXAMPLE
###########################
add_action( 'cmb2_admin_init', 'yourprefix_register_demo_metabox' );
function yourprefix_register_demo_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_yourprefix_demo_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Test Metabox', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		) );
	$cmb_demo->add_field( array(
		'name'       => __( 'Test Text', 'cmb2' ),
		'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => $prefix . 'text',
		'type'       => 'text',
		'repeatable' => 'true' , 
	   'sortable'      => true, // beta
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
		) );
}

###########################
//USER META
###########################

if (isset($_POST['save_lpb_article'])) {
	$article_to_add = get_the_id();
	if (get_user_meta(get_current_user_id() , 'user_inspiration')) {
		$articles = get_user_meta(get_current_user_id() , 'user_inspiration' , true);
		if (!in_array(get_the_id(), $articles)) {
			$articles[] = get_the_id();
			delete_user_meta(get_current_user_id() , 'user_inspiration');
			add_user_meta( get_current_user_id(), 'user_inspiration', $articles );
		}
	} else { 
		add_user_meta( get_current_user_id(), 'user_inspiration', array(0 => get_the_id()) );
	}
}


###########################
//Premium Listing
###########################


return array(
    'post_type'   => 'listing',
    'posts_per_page' => 12,
    'post_status' => 'publish',
    'meta_query'  => array(
        'relation' => 'OR',
        array(
            'key'     => 'premium_listing',
            'compare' => 'NOT EXISTS',
            ),
        array(
            'relation' => 'OR',
            array(
                'key'   => 'premium_listing',
                'value' => 'on',
                ),
            array(
                'key'     => 'premium_listing',
                'value'   => 'on',
                'compare' => '!=',
                ),
            ),
        ),
    'orderby'     => array( 'meta_value' => 'DESC' ),
    );
    
###########################
//Pagination
###########################

		
				global $wp_query;

				$big = 999999999; 
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages
					) );

					?>
