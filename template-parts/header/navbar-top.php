<?php
/**
 * Displays the header top area
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

<div id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-black">

    <?php if ( $header_layout === 'wide' ) : ?>
        <div class="container-fluid">
    <?php elseif ( $header_layout === 'full' ) : ?>
        <div class="container-full">
    <?php elseif ( $header_layout === 'boxed' ) : ?>
        <div class="container">
    <?php endif; ?>

        <!-- Top Links
        ============================================= -->
        <ul id="top-links" class="navbar-nav flex-row">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">USD</a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">EUR</a></li>
                    <li><a href="#" class="dropdown-item">AUD</a></li>
                    <li><a href="#" class="dropdown-item">GBP</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">ENG</a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item"><img src="images/icons/flags/french.png" alt="French"> FR</a></li>
                    <li><a href="#" class="dropdown-item"><img src="images/icons/flags/italian.png" alt="Italian"> IT</a></li>
                    <li><a href="#" class="dropdown-item"><img src="images/icons/flags/german.png" alt="German"> DE</a></li>
                </ul>
            </li>
        </ul><!-- #top-links -->

        <!-- Navbar Toggler
        ============================================= -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#topbarCollapse" aria-controls="topbarCollapse" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Topbar Collapse
        ============================================= -->
        <div id="topbarCollapse" class="collapse navbar-collapse">

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

            <!-- Top Infos
            ============================================= -->
            <ul id="top-infos" class="navbar-nav">
                <li class="nav-item">
                    <div class="top-social">
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </li>
            </ul><!-- #top-infos -->

        </div><!-- #topbarCollapse -->

    </div><!-- .container-(full | fluid) -->

</div><!-- #top-bar -->