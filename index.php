<?php
/**
 * The main template file
 *
 * @package Atahualpa_TCTD
 * @since 4.0.0
 */

get_header();
?>

<main id="main-content" class="site-main" role="main">
    <div class="site-container">
        <div class="layout-wrapper">

            <?php if ( is_active_sidebar( 'sidebar-left' ) ) : ?>
                <aside id="sidebar-left" class="sidebar sidebar-left" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-left' ); ?>
                </aside>
            <?php endif; ?>

            <div class="content-area">
                <?php
                if ( have_posts() ) :

                    // Page header
                    if ( is_home() && ! is_front_page() ) :
                        ?>
                        <header class="page-header">
                            <h1 class="page-title"><?php single_post_title(); ?></h1>
                        </header>
                        <?php
                    endif;

                    // The Loop
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'templates/content', get_post_type() );
                    endwhile;

                    // Pagination
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => esc_html__( '&laquo; Previous', 'atahualpa-tctd' ),
                        'next_text' => esc_html__( 'Next &raquo;', 'atahualpa-tctd' ),
                    ) );

                else :
                    get_template_part( 'templates/content', 'none' );
                endif;
                ?>
            </div>

            <?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
                <aside id="sidebar-right" class="sidebar sidebar-right" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-right' ); ?>
                </aside>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php
get_footer();
