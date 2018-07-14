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
            'publicly_queryable' => true,
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

add_shortcode( 'list-films', 'list_films_shortcode' );
function list_films_shortcode( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'codeline_films',
        'posts_per_page' => 5,
        'order' => 'DESC',
        'orderby' => 'post_date',
    ) );
    if ( $query->have_posts() ) { ?>
        <ul class="films-listing">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </ul>
        <?php $myvariable = ob_get_clean();
        return $myvariable;
    }
}