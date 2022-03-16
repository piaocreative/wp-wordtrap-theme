<?php
/**
 * Displays the header bottom area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

 // Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Global Theme Options
global $wordtrap_options;

// Header Layout
$header_layout = $wordtrap_options['header-layout'];
?>

<div id="navbar_bottom" class="navbar navbar-expand-lg navbar-dark bg-primary">

    <?php if ( $header_layout === 'wide' ) : ?>
        <div class="container-fluid">
    <?php elseif ( $header_layout === 'full' ) : ?>
        <div class="container-full">
    <?php elseif ( $header_layout === 'boxed' ) : ?>
        <div class="container">
    <?php endif; ?>

        <!-- Navbar Toggler
        ============================================= -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#bottomCollapse" aria-controls="bottomCollapse" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Topbar Collapse
        ============================================= -->
        <div id="bottomCollapse" class="collapse navbar-collapse">

            <!-- Top Nabvar
            ============================================= -->
            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'primary',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id'    => 'navbarCollapse',
                    'menu_class'      => 'navbar-nav me-auto',
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu',
                    'depth'           => 2,
                    'walker'          => new Wordtrap_WP_Bootstrap_Navwalker(),
                )
            );
            ?>

        </div><!-- #topbarCollapse -->

    </div><!-- .container-(full | fluid) -->

</div><!-- #top-bar -->