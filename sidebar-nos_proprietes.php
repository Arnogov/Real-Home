<?php

if (is_front_page()) {
    $nb = 6;
    $colClass = 'col-lg-4';
} else{
    $nb = 4;
    $colClass = 'col-lg-3';
}

$lastprops = get_posts(array(
    'numberposts' => $nb,
    'post_type' => 'nos_proprietes',
    'orderby' => 'rand',
    'exclude' => get_the_ID()
));
?>

<section class="sidebar-lastprops bg-light py-5">

    <div class="container">



        <?php if ($lastprops) : ?>

            <div class="row">

                <?php foreach ($lastprops as $post) :
                    setup_postdata($post); ?>

                    <div class="<?= $colClass?>">

                        <?php get_template_part('template-parts/content-archive', get_post_type()); ?>

                    </div>

                <?php endforeach;
                wp_reset_postdata(); ?>

            </div>

            <div class="text-center mb-4">
                <a href="<?= get_post_type_archive_link('nos_proprietes') ?>"
                   class="btn btn-outline-danger my-5"><?php _e('Toutes nos propriétés', 'startheme') ?></a>
            </div>

        <?php endif; ?>

    </div>

</section>
