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


$props = get_posts(array(
    'numberposts' => 9,
    'category_name' => 'nos_proprietes',

));

$villes = get_terms(array(
    'taxonomy' => 'ville',
    'hide_empty' => false,
));
$ville_get = isset($_GET['vil']) ? $_GET['vil'] : [];


get_header();
?>

    <main>

        <section class="archive-section">

            <div class="container">

                <h1 class="page-title text-center text-dark mt-5"><?php the_archive_title(); ?></h1>

            </div>


            <div class="container py-5">

                <aside class="aside-filter bg-light mb-5 p-3">

                    <form action="<?php $_SERVER['REQUEST_URI']; ?>" method="get"
                          class="archive-filter-form form-inline">


                        <div class="form-group w-100">

                            <h3 class="mb-lg-0 mr-4"><?php _e('Toutes', 'startheme') ?></h3>

                            <?php foreach ($villes as $ville) : ?>

                                <div class="form-check form-check-inline">

                                    <input type="checkbox" name="vil[]" value="<?= $ville->term_id ?>"
                                           id="vil-<?= $ville->term_id ?>"
                                           class="vil-filters-field form-check-input"
                                           <?php if (in_array($ville->term_id, $ville_get)) : ?>checked<?php endif; ?>>

                                    <label for="vil-<?= $ville->term_id ?>"
                                           class="form-check-label"><?= $ville->name ?></label>

                                </div>

                            <?php endforeach; ?>

                            <button class="btn btn-outline-primary ml-auto"
                                    type="submit"><?php _e('Filtrer', 'startheme') ?></button>

                        </div>

                    </form>

                </aside>

            </div>

            <div class="container py-1">

                <?php if (have_posts()) : ?>
                    <div class="row mb-4">

                        <?php while (have_posts()) : the_post(); ?>

                            <div class="col-md-6 col-lg-4">

                                <?php get_template_part('template-parts/content-archive', get_post_type()); ?>

                            </div>

                        <?php endwhile; ?>

                    </div><!-- .row -->

                    <?php the_posts_pagination(); ?>

                <?php else : ?>

                    <?php get_template_part('template-parts/content', 'none'); ?>

                <?php endif; ?>

            </div><!-- .container -->

        </section>


    </main>


<?php get_footer() ?>