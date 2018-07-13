<?php
/**
 * Template Name: Film custom page
 * Template Post Type: codeline_films
 *
 * @package unite-child
 */


get_header(); ?>

    <div id="primary" class="content-area col-sm-12 col-md-12">
        <main id="main" class="site-main" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>


                <label>Ticket Price:</label>
                <?php echo get_post_meta(get_the_ID(), 'ticket_price', true); ?>
                <br/>
                <label>Release Date:</label>
                <?php echo get_post_meta(get_the_ID(), 'release_date', true); ?>
                <br/>
                <label>Countries:</label>
                <?php echo get_the_term_list(get_the_ID(), 'countries', '', ', '); ?>
                <br/>
                <label>Genres:</label>
                <?php echo get_the_term_list(get_the_ID(), 'genres', '', ', '); ?>
                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() ) :
                        comments_template();
                    endif;
                ?>

            <?php endwhile; // end of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_footer(); ?>