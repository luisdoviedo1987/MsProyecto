<?php

function gallery_size_h($height) {
return '600';
}
add_filter( 'et_pb_blog_image_height', 'gallery_size_h' );
function gallery_size_w($width) {
return '300';
}
add_filter( 'et_pb_blog_image_width', 'gallery_size_w' );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );}
	

//======================================================================
// CUSTOM DASHBOARD
//======================================================================
// ADMIN FOOTER TEXT
function remove_footer_admin () {
    echo "Divi Child Theme";
} 

add_filter('admin_footer_text', 'remove_footer_admin');

// RENAME PROJECT CUSTOM POST TYPE DIVI THEME
function rename_project_cpt() {

register_post_type( 'project',
	array(
	'labels' => array(
	'name'          => __( 'ClubSmart', 'divi' ), // change the text Projects to anything you like
	'singular_name' => __( 'ClubSmart', 'divi' ), // change the text Project to anything you like
	),
	'has_archive'  => true,
	'hierarchical' => true,
    'menu_icon'    => 'dashicons-images-alt2',  // you choose your own dashicon
	'public'       => true,
	
	'rewrite'      => array( 'slug' => 'clubsmart', 'with_front' => false ), // change the text portfolio to anything you like
  'supports'     => array(),
         
));
    }


	/*function alianzasEstrategigas() {

		register_post_type( 'alianzas',
			array(
			'labels' => array(
			'name'          => __( 'Alianzas', 'divi' ), // change the text Projects to anything you like
			'singular_name' => __( 'Alianzas', 'divi' ), // change the text Project to anything you like
			),
			'has_archive'  => true,
			'hierarchical' => true,
			'menu_icon'    => 'dashicons-images-alt2',  // you choose your own dashicon
			'public'       => true,
			
			'rewrite'      => array( 'slug' => 'alianzas', 'with_front' => false ), // change the text portfolio to anything you like
		  'supports'     => array(),
				 
		));
			}*/

add_action( 'init', 'rename_project_cpt' );
//add_action( 'init', 'alianzasEstrategigas' );


function cptui_register_my_cpts() {

	/**
	 * Post Type: Alianzas.
	 */

	$labels = [
		"name" => __( "Alianzas", "custom-post-type-ui" ),
		"singular_name" => __( "alianza", "custom-post-type-ui" ),
		"menu_name" => __( "Mi Alianzas", "custom-post-type-ui" ),
		"all_items" => __( "Todos los Alianzas", "custom-post-type-ui" ),
		"add_new" => __( "Añadir nuevo", "custom-post-type-ui" ),
		"add_new_item" => __( "Añadir nuevo alianza", "custom-post-type-ui" ),
		"edit_item" => __( "Editar alianza", "custom-post-type-ui" ),
		"new_item" => __( "Nuevo alianza", "custom-post-type-ui" ),
		"view_item" => __( "Ver alianza", "custom-post-type-ui" ),
		"view_items" => __( "Ver Alianzas", "custom-post-type-ui" ),
		"search_items" => __( "Buscar Alianzas", "custom-post-type-ui" ),
		"not_found" => __( "No se ha encontrado Alianzas", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No se han encontrado Alianzas en la papelera", "custom-post-type-ui" ),
		"parent" => __( "alianza superior", "custom-post-type-ui" ),
		"featured_image" => __( "Imagen destacada para alianza", "custom-post-type-ui" ),
		"set_featured_image" => __( "Establece una imagen destacada para alianza", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Eliminar la imagen destacada de alianza", "custom-post-type-ui" ),
		"use_featured_image" => __( "Usar como imagen destacada de alianza", "custom-post-type-ui" ),
		"archives" => __( "Archivos de alianza", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insertar en alianza", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Subir a alianza", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filtrar la lista de Alianzas", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Navegación de la lista de Alianzas", "custom-post-type-ui" ),
		"items_list" => __( "Lista de Alianzas", "custom-post-type-ui" ),
		"attributes" => __( "Atributos de Alianzas", "custom-post-type-ui" ),
		"name_admin_bar" => __( "alianza", "custom-post-type-ui" ),
		"item_published" => __( "alianza publicado", "custom-post-type-ui" ),
		"item_published_privately" => __( "alianza publicado como privado.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "alianza devuelto a borrador.", "custom-post-type-ui" ),
		"item_scheduled" => __( "alianza programado", "custom-post-type-ui" ),
		"item_updated" => __( "alianza actualizado.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "alianza superior", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Alianzas", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "alianzas", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "author", "page-attributes", "post-formats" ],
		"taxonomies" => [ "category" ],
		"show_in_graphql" => false,
	];

	register_post_type( "alianzas", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
