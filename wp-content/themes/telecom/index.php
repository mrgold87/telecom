<?php get_header(); ?>
<section class="main">
    <div class="page__container">
        <div class="main__row">
            <?php while (have_posts()) : the_post(); ?>
                <h1 class="main__title"><?php the_title(); ?></h1>
                <div class="main__text"><?php the_content(''); ?></div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
