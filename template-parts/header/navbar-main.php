<?php
/**
 * Displays the header main area
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

<div id="navbar_main" class="navbar navbar-expand-lg navbar-light">
    
    <?php if ( $header_layout === 'wide' ) : ?>
        <div class="container-fluid">
    <?php elseif ( $header_layout === 'full' ) : ?>
        <div class="container-full">
    <?php elseif ( $header_layout === 'boxed' ) : ?>
        <div class="container">
    <?php endif; ?>

        <!-- Logo
        ============================================= -->	
        <?php echo wordtrap_logo(); ?>

        <!-- Navbar Toggler
        ============================================= -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div><!-- .container-(full | fluid) -->

</div>