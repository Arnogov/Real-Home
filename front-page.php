<?php
/**
 * The template file for front page
 *
 * ...
 *
 * @package WordPress
 * @subpackage Startheme
 * @since 1.0.0
 *
 */


get_header();
?>

    <main>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php get_template_part('template-parts/content', 'front-page'); ?>

        <?php endwhile;
        endif; ?>

    </main>

    <section class="front-props container">

        <?php if ($lastprops) : ?>

            <div class="front-props_grid">

                <?php foreach ($lastprops as $post) :
                    setup_postdata($post); ?>

                    <?php get_template_part('template-parts/content-archive', 'prop'); ?>

                <?php endforeach;
                wp_reset_postdata(); ?>

            </div>

        <?php endif; ?>

    </section>

<?php get_sidebar('nos_proprietes') ?>

<?php get_footer() ?>