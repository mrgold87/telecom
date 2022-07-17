<?php
function telecom_support_title()
{
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'telecom_support_title');
add_theme_support('post-thumbnails', array('slider'));
add_image_size('slider-thumb', 436, 315, true);
// css / js
function telecom_scripts()
{
    wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');
    wp_enqueue_style('telecom-main', get_template_directory_uri() . '/css/main.css');
    wp_enqueue_style('telecom-style', get_stylesheet_uri());

    wp_enqueue_script('jquery');
    wp_enqueue_script('owl.carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js', array('jquery'), false, true);
    wp_enqueue_script('init-owl-carousel', get_template_directory_uri() . '/js/custom.js', array('jquery', 'owl.carousel'), false, true);
}

add_action('wp_enqueue_scripts', 'telecom_scripts');

//CPT
add_action('init', 'telecom_register_post_type_init');

function telecom_register_post_type_init()
{
    $labels = [
        'name' => 'Слайдер',
        'singular_name' => 'Слайдер',
        'add_new' => 'Добавить новый слайд',
        'add_new_item' => 'Добавить новый слайд',
        'edit_item' => 'Редактировать слайд',
        'new_item' => 'Новый слайд',
        'all_items' => 'Все слайды',
        'search_items' => 'Поиск по слайдам',
        'not_found' => 'Не найдено',
        'menu_name' => 'Слайдер',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'slider'],
        'supports' => ['title', 'editor', 'thumbnail'],
    ];

    register_post_type('slider', $args);

    unset($args);
    unset($labels);

    $labels = [
        'name' => 'Тарифы',
        'singular_name' => 'Тариф',
        'add_new' => 'Добавить новый тариф',
        'add_new_item' => 'Добавить новый тариф',
        'edit_item' => 'Редактировать тариф',
        'new_item' => 'Новый тариф',
        'all_items' => 'Все тарифы',
        'search_items' => 'Поиск по тарифам',
        'not_found' => 'Не найдено',
        'menu_name' => 'Тарифы',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'tariff'],
        'supports' => ['title', 'editor'],
    ];

    register_post_type('tariff', $args);
}

//metaboxes
function telecom_add_metabox()
{
    add_meta_box('book_info_metabox',
        'Данные тарифа',
        'telecom_add_metabox_cb',
        array('tariff'));
}

function telecom_add_metabox_cb($post)
{

    wp_nonce_field('tariff_action', 'tariff_nonce');
    $tariff_speed = get_post_meta($post->ID, 'tariff_speed', true);
    $toggle_tv = get_post_meta($post->ID, 'toggle_tv', true);
    $tariff_price = get_post_meta($post->ID, 'tariff_price', true);
    $tariff_footnote = get_post_meta($post->ID, 'tariff_footnote', true);
    ?>
    <table class="form-table">
        <tbody>
        <tr>
            <th><label for="tariff_speed">Скорость интернета:</label></th>
            <td><input type="text" id="tariff_speed" name="tariff_speed" class="regular-text"
                       value="<?php echo esc_attr($tariff_speed) ?>"></td>
        </tr>
        <tr>
            <th><label for="toggle_tv">Добавить ТВ в пакет?</label></th>
            <td><input type="checkbox" id="toggle_tv" name="toggle_tv" <?php checked('yes', $toggle_tv) ?>></td>
        </tr>
        <tr>
            <th><label for="tariff_price">Стримость по тарифу:</label></th>
            <td><input type="text" id="tariff_price" name="tariff_price" class="regular-text"
                       value="<?php echo esc_attr($tariff_price) ?>"></td>
        </tr>
        <tr>
            <th><label for="tariff_footnote">Примечание к тарифу:</label></th>
            <td>
                <textarea id="tariff_footnote" name="tariff_footnote" rows="5"
                          class="regular-text"><?php echo esc_attr($tariff_footnote) ?></textarea>
            </td>
        </tr>
        </tbody>
    </table>
    <?php
}

add_action('add_meta_boxes', 'telecom_add_metabox');
//save meta-box
function telecom_save_metabox($post_id)
{

    if (!isset($_POST['tariff_nonce']) || !wp_verify_nonce($_POST['tariff_nonce'], 'tariff_action')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (!empty($_POST['tariff_speed'])) {
        update_post_meta($post_id, 'tariff_speed', sanitize_text_field($_POST['tariff_speed']));
    } else {
        delete_post_meta($post_id, 'tariff_speed');
    }
    if (isset($_POST['toggle_tv']) && $_POST['toggle_tv'] == 'on') {
        update_post_meta($post_id, 'toggle_tv', 'yes');
    } else {
        delete_post_meta($post_id, 'toggle_tv');
    }
    if (!empty($_POST['tariff_price'])) {
        update_post_meta($post_id, 'tariff_price', sanitize_text_field($_POST['tariff_price']));
    } else {
        delete_post_meta($post_id, 'tariff_price');
    }
    if (!empty($_POST['tariff_footnote'])) {
        update_post_meta($post_id, 'tariff_footnote', sanitize_text_field($_POST['tariff_footnote']));
    } else {
        delete_post_meta($post_id, 'tariff_footnote');
    }
}

add_action('save_post', 'telecom_save_metabox');
// get meta-box
function telecom_get_tariff_speed($post_id)
{
    $tariff_speed = get_post_meta($post_id, 'tariff_speed', true);
    return $tariff_speed ? $tariff_speed : '';
}

function telecom_get_toggle_tv($post_id)
{
    $toggle_tv = get_post_meta($post_id, 'toggle_tv', true);
    return $toggle_tv ? 'on' : 'off';
}

function telecom_get_tariff_price($post_id)
{
    $tariff_price = get_post_meta($post_id, 'tariff_price', true);
    return $tariff_price ? $tariff_price : '';
}

function telecom_get_tariff_footnote($post_id)
{
    $tariff_footnote = get_post_meta($post_id, 'tariff_footnote', true);
    return $tariff_footnote ? $tariff_footnote : '1111';
}

//register widget
function telecom_register_widgets()
{

    register_sidebar(array(
        'name' => 'Область под контактрую форму',
        'id' => 'contact-form-widget-area',
        'description' => 'Область под контактрую форму',
        'before_widget' => ' <div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',

    ));

}

add_action('widgets_init', 'telecom_register_widgets');