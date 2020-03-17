<?php
/**
 * The template for displaying archive pages
 *
 *
 * @package WordPress
 * @subpackage Startheme
 * @since 1.0.0
 *
 */


$news = get_posts(array(
    'numberposts' => 3,
    'category_name' => 'actualites',

));
get_header();
?>

    <main>

        <?php if ($news) : ?>

            <section class="archive-section mb-5">


                <div class="container">

                    <h1 class="page-title text-center text-dark mt-5"><?php the_archive_title(); ?></h1>

                </div>


                <div class="container py-5">

                    <div class="row flex-md-row-reverse">

                        <aside class="col aside-categories mb-4">

                            <ul class="bg-light p-3">

                                <?php wp_list_categories(array(
                                    'child_of' => 5,
                                    'title_li' => '<h3>' . __('Categories') . '</h3>'
                                )); ?>

                            </ul>

                            <ul class="bg-light p-3">
                                <h3>Archives</h3>
                                <?php wp_get_archives(array(
                                    'type' => 'monthly',
                                    'order' => 'ASC',
                                    'title_li' => '<h3>' . __('Archives', 'startheme') . '</h3>'
                                )) ?>
                            </ul>

                        </aside>


                        <div class="col-md-8 col-lg-9">

                            <?php foreach ($news as $post) :
                                setup_postdata($post); ?>


                                <?php get_template_part('template-parts/content-archive', get_post_type()); ?>

                            <?php endforeach;
                            wp_reset_postdata(); ?>

                            <?php the_posts_pagination(); ?>

                        </div>

                    </div><!-- .row -->

                </div><!-- .container -->

            </section>

        <?php else : ?>

            <?php get_template_part('template-parts/content', 'none'); ?>

        <?php endif; ?>

    </main>

<?php get_footer() ?>