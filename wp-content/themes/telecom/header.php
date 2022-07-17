<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('page'); ?>>
<?php wp_body_open(); ?>
<header class="header">
    <div class="page__container">
        <div class="header__row">
            <div class="logo"><img src="<?php echo get_template_directory_uri() . '/img/logo.png'; ?>" alt="logo"></div>
            <div class="icon-menu"></div>
        </div>
    </div>
</header>