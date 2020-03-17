<?php
/**
 * The last posts sidebar displayed before footer
 *
 * @package startheme
 */

$exclude = is_single() ? get_option('sticky_posts') : get_the_ID();
$lastnews = get_posts(array(
    'numberposts' => 3,
    'category_name' => 'actualites',
    'exclude' => $exclude
));
?>

<section class="sidebar-lastnews bg-light">

        <h3 class="sidebar-title"><?php _e('Dernières publications', 'startheme') ?></h3>

        <?php if ($lastnews) : ?>



                <?php foreach ($lastnews as $post) :
                    setup_postdata($post); ?>

                    <article class="bg-light" <?php post_class('card border-0'); ?>>
                        <h5 class="entry-title"><?php the_title(); ?></h5>
                        <?php the_time('d F Y'); ?>

                        <div class="mb-3">
                            <?php the_excerpt(); ?>
                        </div>

                    </article>

                <?php endforeach;
               ?>



        <?php endif; ?>
        <a href="<?= esc_url(get_category_link(5)) ?>"
           class="btn btn-outline-danger mt-4"><?php _e('Toutes les actualités', 'startheme') ?></a>

</section>