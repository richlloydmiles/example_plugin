<?php 
/*
 * Plugin Name:OTC Media Plugin
 */

?>

<?php 

############################
# CMB DECLAREATION
############################
if ( ! defined( 'CMB_PATH') ) {
	include_once( plugin_dir_path( __FILE__ ) . '/cmb/custom-meta-boxes.php' );
}


############################
# REGISTER POST TYPE AND TAXONOMY
############################
// add_action('init' , function() {
	///////////////////////////////////////////
	///News Post Type
	///////////////////////////////////////////
// 	$singular_name = '';
// 	$plural_name = '';
// 	$labels = array(
// 		'name'               => _x( "$singular_name", "post type general name", "wobble" ),
// 		"singular_name"      => _x( "$plural_name", "post type singular name", "wobble" ),
// 		"menu_name"          => _x( "$singular_name", "admin menu", "wobble" ),
// 		"name_admin_bar"     => _x( "$singular_name", "add new on admin bar", "wobble" ),
// 		"add_new"            => _x( "Add New", "$plural_name", "wobble" ),
// 		"add_new_item"       => __( "Add New $plural_name", "wobble" ),
// 		"new_item"           => __( "New $plural_name", "wobble" ),
// 		"edit_item"          => __( "Edit $plural_name", "wobble" ),
// 		"view_item"          => __( "View $plural_name", "wobble" ),
// 		"all_items"          => __( "All $singular_name", "wobble" ),
// 		"search_items"       => __( "Search $singular_name", "wobble" ),
// 		"parent_item_colon"  => __( "Parent $plural_name:", "wobble" ),
// 		"not_found"          => __( "No $singular_name found.", "wobble" ),
// 		"not_found_in_trash" => __( "No $singular_name found in Trash.", "wobble" )
// 		);

// $args = array(
// 	'labels'             => $labels, 
// 	'public'             => true,
// 	'publicly_queryable' => true,
// 	'show_ui'            => true,
// 	'show_in_menu'       => true,
// 	'query_var'          => true,
// 	'capability_type'    => 'post',
// 	'has_archive'        => true,
// 	'hierarchical'       => false,
// 	'menu_position'      => null, 
// 	'supports'           => array( 'title' , 'editor' , 'thumbnail'),
// 	'menu_icon'			 => 'dashicons-index-card'
// 	);

	#https://developer.wordpress.org/resource/dashicons/

// register_post_type( 'service', $args ); 

// $singular_name = '';
// $plural_name = '';
// $labels = array(
// 	'name'              => _x( "$plural_name", "taxonomy general name" ),
// 	"singular_name"     => _x( "$singular_name", "taxonomy singular name" ),
// 	"search_items"      => __( "Search $plural_name" ),
// 	"all_items"         => __( "All $plural_name" ),
// 	"parent_item"       => __( "Parent $singular_name" ),
// 	"parent_item_colon" => __( "Parent $singular_name:" ),
// 	"edit_item"         => __( "Edit $singular_name" ),
// 	"update_item"       => __( "Update $singular_name" ),
// 	"add_new_item"      => __( "Add New $singular_name" ),
// 	"new_item_name"     => __( "New $singular_name Name" ),
// 	"menu_name"         => __( "$singular_name" ),
// 	);

// $args = array(
// 	'hierarchical'      => true,
// 	'labels'            => $labels,
// 	'show_ui'           => true,
// 	'show_admin_column' => true,
// 	'query_var'         => true,
// 	'rewrite'           => array( 'slug' => 'it-solutions' ),
// 	);

// register_taxonomy( 'it_solution', 'service' ,  $args );

// });

############################
# CUSTOMIZOR FIELDS
############################

// add_action( 'customize_register', function($wp_customize ) {
// 	$wp_customize->add_section( 'features_images' , array(
// 		'title'       => __( 'Custom Feature Images', 'dial' ),
// 		'priority'    => 30,
// 		) );
// 	$wp_customize->add_setting( 'default_banner' );

// 	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'default_banner', array(
// 		'label'    => __( 'Default Site Banner Image', 'dial' ),
// 		'section'  => 'features_images',
// 		'settings' => 'default_banner',
// 		) ) );

// 	$wp_customize->add_section( 'contact-info' , array(
// 		'title' => __( 'General Information', '_tk' ),
// 		'priority' => 30
// 		) );

// 	$wp_customize->add_setting( 'phone' , array( 'default' => '' ));
// 	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'phone', array(
// 		'label' => __( 'Phone Number', '_tk' ),
// 		'section' => 'contact-info',
// 		'settings' => 'phone',
// 		) ) );

// } );
//get_theme_mod('phone' , '');
//

############################
# SHORTCODE
############################
#
//[latest_news]
// add_shortcode('latest_news' , function($args) {
// 	ob_start();
// 	query_posts( array(
		// 'post_type' => 'venue',
		// 'showposts' => '-1' ,
		// 'orderby' => 'meta_value',
		// 'meta_query' => array(
		// 	array('key' => 'featured'),
		// 	array('value' => '1')),
// 		)); 
// 		?>
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
// 					if ($i%2 == 0) echo '</div><div class="row">';
// 					?>
 				<?php endwhile; // end of the loop. ?>	
 			</div>	
 		</div>
 		<?php
// 		$temp = ob_get_contents();
// 		ob_end_clean();
// 		return $temp;
// 	});
?>