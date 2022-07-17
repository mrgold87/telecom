<?php
get_header();
$slider_query = new WP_Query(array(
    "post_type" => "slider",
    'posts_per_page' => '-1',
));
?>
    <section class="slider">
        <?php if ($slider_query->have_posts()) : ?>
        <div class="slider__container owl-carousel slider-carousel">
            <?php
            while ($slider_query->have_posts()) : $slider_query->the_post();
                ?>
                <div class="slider__row">
                    <div class="slider__description">
                        <h2 class="slider__title"><?php the_title(); ?> </h2>
                        <div class="slider__caption">
                            <?php the_content('', false); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="button slider__button">Подробнее</a>
                    </div>
                    <div class="slider__image">
                        <?php
                        if (has_post_thumbnail()):
                            $post_id = get_the_ID();
                            $thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
                            ?>
                            <img src="<?php echo wp_get_attachment_image_url($thumbnail_id, 'slider-thumb'); ?>"
                                 alt="<?php the_title(); ?>"/>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
            endwhile;
                wp_reset_postdata();
                ?>
        </div>
        <?php else: ?>
        <div class="page__container"> <p><?php echo 'Слайдер пуст...' ?></p></div>
        <?php endif; ?>
    </section>
<?php
$tariff_query = new WP_Query(array(
    "post_type" => "tariff",
    'posts_per_page' => '-1',
));
?>
    <section class="tariff">
        <div class="tariff__container">
            <?php if ($tariff_query->have_posts()) :  ?>
            <h2 class="tariff__title">Тарифные планы</h2>
            <div class="owl-carousel  tariff-carousel">
                <?php
               while ($tariff_query->have_posts()) : $tariff_query->the_post();
                    ?>
                    <div class="tariff__item item">
                        <h3 class="item__title"><?php the_title(); ?></h3>
                        <span class="item__caption">Скорость интернета</span>
                        <h4 class="item__speed"><?php echo telecom_get_tariff_speed(get_the_ID()); ?> Мбит/с</h4>
                        <div class="item__description">
                            <?php the_content('', false); ?>
                        </div>
                        <div class="item__tv">
                            <div class="item__icon-<?php echo telecom_get_toggle_tv(get_the_ID()); ?>"></div>
                            <div class="item__basic">
                                <span>ТВ + 100 ₽</span>
                                <span>(пакет “Базовый”)</span>
                            </div>
                        </div>

                        <div class="item__price"><span><?php echo telecom_get_tariff_price(get_the_ID()); ?> ₽</span>
                            <div>в месяц</div>
                        </div>
                        <div class="item__footnote">
                            *<?php echo telecom_get_tariff_footnote(get_the_ID()); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="button button_all-width">Выбрать тариф</a>

                    </div>
                <?php
                endwhile;
                    ?>

            </div>
            <?php else: ?>

                <div class="page__container">  <p><?php echo 'Тарифов нет...' ?></p></div>
            <?php endif; ?>
        </div>
    </section>
<?php if (is_active_sidebar('contact-form-widget-area')) : ?>
    <section class="request">
        <div class="request__container">
            <div class="form">
                <h2 class="form__title">Подключиться просто!</h2>
                <div class="form__services">
                    <a class="form__services-button_active" href="#" data-service="Интернет">Интернет</a>
                    <a class="" href="#" data-service="Интернет + ТВ">Интернет + ТВ</a>
                    <a class="" href="#" data-service="Телефония">Телефония</a>
                    <a class="" href="#" data-service="Видеонаблюдение">Видеонаблюдение</a>
                </div>
                <div class="contact-form-7">
                    <?php dynamic_sidebar('contact-form-widget-area'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php get_footer();