<?php

function my_theme_enqueue_styles() {

    $parent_style = 'unite-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'unite-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function create_post_type() {
    register_post_type( 'codeline_films',
        array(
            'labels' => array(
                'name' => __( 'Films' ),
                'singular_name' => __( 'Film' )
            ),
            'public' => true,
            'has_archive' => true,
        )
    );
}
add_action( 'init', 'create_post_type' );

function create_taxonomy() {
	register_taxonomy(
		'genres',
		'codeline_films',
		array(
			'label' => __( 'Genres' ),
			'rewrite' => array( 'slug' => 'genre' ),
		)
	);

    register_taxonomy(
        'countries',
        'codeline_films',
        array(
            'label' => __( 'Countries' ),
            'rewrite' => array( 'slug' => 'country' ),
        )
    );


    register_taxonomy(
        'years',
        'codeline_films',
        array(
            'label' => __( 'Years' ),
            'rewrite' => array( 'slug' => 'year' ),
        )
    );

    register_taxonomy(
        'actors',
        'codeline_films',
        array(
            'label' => __( 'Actors' ),
            'rewrite' => array( 'slug' => 'actor' ),
        )
    );
}
add_action( 'init', 'create_taxonomy' );
