<?php
/**
 * Template Name: Front Page
 */

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
            <div class="page__container"><p><?php echo 'Слайдер пуст...' ?></p></div>
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
            <?php if ($tariff_query->have_posts()) : ?>
                <h2 class="tariff__title">Тарифные планы</h2>
                <div class="owl-carousel  tariff-carousel">
                    <?php
                    while ($tariff_query->have_posts()) : $tariff_query->the_post();
                        $tariff_speed = get_field('tariff_speed');
                        $tariff_tv = get_field('tariff_tv');
                        $tariff_price = get_field('tariff_price');
                        $tariff_footnote = get_field('tariff_footnote');
                        $tariff_tv = $tariff_tv[0];
                        ?>
                        <div class="tariff__item item">
                            <h3 class="item__title"><?php the_title(); ?></h3>
                            <span class="item__caption">Скорость интернета</span>
                            <h4 class="item__speed"><?php echo $tariff_speed ? $tariff_speed : ''; ?> Мбит/с</h4>
                            <div class="item__description">
                                <?php the_content('', false); ?>
                            </div>
                            <div class="item__tv">
                                <div class="item__icon-<?php if ($tariff_tv =='Да') {echo 'on';} else{echo 'off';} ?>"></div>
                                <div class="item__basic">
                                    <span>ТВ + 100 ₽</span>
                                    <span>(пакет “Базовый”)</span>
                                </div>
                            </div>

                            <div class="item__price">
                                <span><?php echo $tariff_price ? $tariff_price : ''; ?> ₽</span>
                                <div>в месяц</div>
                            </div>
                            <div class="item__footnote">
                                <?php echo $tariff_footnote ? '* '.$tariff_footnote : ''; ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="button button_all-width">Выбрать тариф</a>

                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>

                </div>
            <?php else: ?>

                <div class="page__container"><p><?php echo 'Тарифов нет...' ?></p></div>
            <?php endif; ?>
        </div>
    </section>
<?php
$form_id = get_field('contact_form');
if (!empty($form_id)):
    ?>
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
                    <?php echo do_shortcode("[contact-form-7 id=$form_id] "); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php get_footer();