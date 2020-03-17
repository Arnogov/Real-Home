<?php
/**
 * The template file for displaying single posts and pages
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

    <main class="container py-5">

        <div class="row">

            <div class="col-md-8">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <?php get_template_part('template-parts/content', get_post_type()); ?>

                <?php endwhile;
                endif; ?>


            </div>

            <aside class="col aside-categories mb-4">

                <ul class="bg-light p-3">

                    <?php wp_list_categories(array(
                        'child_of' => 5,
                        'title_li' => '<h3>' . __('Categories') . '</h3>'
                    )); ?>

                    <?php get_sidebar('lastnews'); ?>
                </ul>

            </aside>

        </div>


    </main>


<?php get_footer() ?>