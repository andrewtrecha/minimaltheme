<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Minimal
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'gtma-starter' ); ?></a>

    <!--HEADER-->
    <header id="header" uk-sticky="show-on-up: true; animation: uk-animation-slide-top; media: @l">

        <!--MAIN NAV-->
        <div class="navbar-wrapper">
            <div class="uk-container uk-container-expand">
                <nav id="navbar" class="uk-navbar-transparent uk-flex-middle uk-navbar" uk-navbar data-uk-navbar="mode: hover;">
                    <div class="logo-wrap uk-navbar-item uk-navbar-left uk-padding-remove-horizontal">

                        <?php if( has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <a class="uk-logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                        <?php endif; ?>

                    </div>

                    <div class="main-nav-wrapper uk-navbar-right uk-visible@m">

                        <?php wp_nav_menu(
                            array(
									'menu'              => 'Main Menu',
									'theme_location'    => 'main-nav',
									'container'         => 'false',
									'menu_class'        => 'uk-navbar-nav uk-flex uk-flex-between uk-flex-nowrap',
									'walker'            => new gs_primary_menu()
								)
                            );
                        ?>
                        
                        <a class="uk-navbar-toggle uk-hidden@m" aria-label="Open the menu" data-uk-toggle data-uk-navbar-toggle-icon href="#mobile-nav"></a>
                        
                    </div>
                    <div class="mobile-nav-toggle uk-navbar-right uk-hidden@m"<?php if( is_singular('rentpress_property') || is_singular('rentpress_floorplan') ) : ?> uk-sticky<?php endif; ?>>
                        <a class="uk-navbar-toggle" data-uk-toggle data-uk-navbar-toggle-icon href="#mobile-nav" aria-label="Open the menu"></a>
                    </div>
                </nav>
            </div>
        </div>
        <!--/MAIN NAV-->

    </header>
    <!--/HEADER-->
