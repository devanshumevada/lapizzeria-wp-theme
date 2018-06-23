<?php


	//Link or Import the database.php file

	require get_template_directory() . '/inc/database.php';
	require get_template_directory() . '/inc/reservations.php';
	require get_template_directory() . '/inc/option.php';



	function lapizzeria_theme_setup() {

			add_theme_support('post-thumbnails');
			add_image_size('boxes', 437, 299, true);
			add_image_size('specialties',768,515,true);
			add_image_size('specialty-portrait',435,530,true);
			update_option('thumbnail_size_w', 253);
			update_option('thumbnail_size_h',164);

			add_theme_support('title-tag');

	}

	add_action('after_setup_theme','lapizzeria_theme_setup');


	function lapizzeria_styles() {



	   wp_register_style('googlefont', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway:400,700,900', array(), '1.0.0');
	   wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '7.0.0');
	   wp_register_style('fluidbox_css',get_template_directory_uri() . '/css/fluidbox.min.css',array(),'0.0.0');
	   wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.7.0');
	   wp_register_style('datetime-local', get_template_directory_uri() . '/css/datetime-local-polyfill.css', array(), '1.0.0');
	   wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');


	   wp_enqueue_style('normalize');
	   wp_enqueue_style('font-awesome');
	   wp_enqueue_style('style');
	   wp_enqueue_style('googlefont');
	   wp_enqueue_style('fluidbox_css');

	   //javascript File //

		$api_key = esc_html(get_option('lapizzeria_gmap_apikey'));
		wp_register_script('fluidbox_js',get_template_directory_uri() . '/js/jquery.fluidbox.min.js',array('jquery'),'1.0.0', true);
		wp_register_script('googlemap','https://maps.googleapis.com/maps/api/js?key='.$api_key.'&callback=initMap',array(),'',true);
		wp_register_script('datetime-local-polyfill', get_template_directory_uri() . '/js/datetime-local-polyfill.min.js', array('jquery','jquery-ui-core','jquery-ui-datepicker','modernizr'), '1.0.0', true);
	    wp_register_script('script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
	    wp_register_script('recaptcha','https://www.google.com/recaptcha/api.js');
	    wp_enqueue_script('jquery');
	    wp_enqueue_script('script');
		wp_enqueue_script('fluidbox_js');
	    wp_enqueue_script('googlemap');
	    wp_enqueue_script('jquery-ui-core');
	    wp_enqueue_script('jquery-ui-datepicker');
	    wp_enqueue_script('datetime-local-polyfill');
	    wp_enqueue_script('recaptcha');

	    wp_localize_script(
	    	'script',
		    'options',
		    array(
		    	'latitude' => esc_html(get_option('lapizzeria_gmap_latitude')),
			    'longitude' => esc_html(get_option('lapizzeria_gmap_longitude')),
			    'zoom' => esc_html(get_option('lapizzeria_gmap_zoom')),
			    'API_Key' => esc_html(get_option('lapizzeria_gmap_apikey'))
	         )

	    );

	}
	  add_action('wp_enqueue_scripts', 'lapizzeria_styles');

	function lapizzeria_admin_scripts() {

		wp_register_style('sweetalert',get_template_directory_uri() . '/css/sweetalert2.min.css');
		wp_register_script('sweetalert_js',get_template_directory_uri() . '/js/sweetalert2.min.js');
		wp_register_script('admin_js',get_template_directory_uri() . '/js/admin_ajax.js', array('jquery'),'1.0', true );
		wp_enqueue_script('admin_js');
		wp_enqueue_style('sweetalert');
		wp_enqueue_script('sweetalert_js');

		wp_localize_script(
			'admin_js',
			'admin_ajax',
			array(
				'ajaxurl' => admin_url('admin-ajax.php')

			)

		);
	}

	add_action('admin_enqueue_scripts','lapizzeria_admin_scripts');


   function lapizzeria_menu() {

   	register_nav_menus(array(

       'header-menu' => __('Header Menu','lapizzeria'),
       'social-menu' => __('Social Menu', 'lapizzeria')


     ));

   }

   add_action('init','lapizzeria_menu');


   // Custom footer copyright Text

	function lapizzeria_custom_footer_copyright_phone_address ($wp_customize) {

		$wp_customize -> add_section('custom_copyright_section',array(
			'title' => 'Custom Copyright Section'
		));

		$wp_customize -> add_setting('custom_copyright_section_text',array(

			'default' => 'Your Footer Text'
		));

		$wp_customize -> add_control(new WP_Customize_Control($wp_customize,'custom-footer',array(
			'label' => 'Enter your copyright Text here',
			'section' => 'custom_copyright_section',
			'settings' => 'custom_copyright_section_text'
		)));

		$wp_customize -> add_section('res_address',array(
			'title' => 'Address and Phone number section'
		));

		$wp_customize -> add_setting('custom_address',array(
			'default' => 'Your address'
		));

		$wp_customize -> add_control(new WP_Customize_Control($wp_customize,'custom_addresss_wp',array(
			'label' => 'Enter address',
			'section' => 'res_address',
			'settings' => 'custom_address'
		)));

		$wp_customize -> add_setting('phone_number',array(
			'default' => 'Add your Phone Number'
		));

		$wp_customize -> add_control(new WP_Customize_Control($wp_customize,'phone_number_wp',array(
			'label' => 'Enter Phone Number',
			'section' => 'res_address',
			'settings' => 'phone_number'
		)));



	}

	add_action('customize_register', 'lapizzeria_custom_footer_copyright_phone_address');


	function lapizzeria_specialties() {

		$labels = array(
			'name'               => _x( 'Pizzas', 'lapizzeria' ),
			'singular_name'      => _x( 'Pizza', 'post type singular name', 'lapizzeria' ),
			'menu_name'          => _x( 'Pizzas', 'admin menu', 'lapizzeria' ),
			'name_admin_bar'     => _x( 'Pizzas', 'add new on admin bar', 'lapizzeria' ),
			'add_new'            => _x( 'Add New', 'book', 'lapizzeria' ),
			'add_new_item'       => __( 'Add New Pizza', 'lapizzeria' ),
			'new_item'           => __( 'New Pizzas', 'lapizzeria' ),
			'edit_item'          => __( 'Edit Pizzas', 'lapizzeria' ),
			'view_item'          => __( 'View Pizzas', 'lapizzeria' ),
			'all_items'          => __( 'All Pizzas', 'lapizzeria' ),
			'search_items'       => __( 'Search Pizzas', 'lapizzeria' ),
			'parent_item_colon'  => __( 'Parent Pizzas:', 'lapizzeria' ),
			'not_found'          => __( 'No Pizzas found.', 'lapizzeria' ),
			'not_found_in_trash' => __( 'No Pizzas found in Trash.', 'lapizzeria' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'lapizzeria' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'specialties' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'          => array( 'category' ),
		);
		register_post_type( 'specialties', $args );
	}

	add_action('init','lapizzeria_specialties');


	/* Widget zone */

	function lapizzeria_widgets() {

		register_sidebar(array(
			'name' => 'Blog Sidebar',
			'id' => 'blog_sidebar',
			'before_widget' => '<div class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		));

	}

	add_action('widgets_init','lapizzeria_widgets');

	function add_sync_defer($tag, $handle) {
		if('googlemap' != $handle) {
			return $tag;
		}

		return str_replace('src','async="async" defer="defer" src',  $tag);
	}

	add_filter('script_loader_tag','add_sync_defer',10, 2);
?>
