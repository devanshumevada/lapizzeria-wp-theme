<!doctype html>
<html lang="en">
      <head>
        <meta charset="<?php bloginfo('charset'); ?>" / />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- iOS Compatibility -->
       <meta name="apple-mobile-web-app-capable" content="yes"/>
       <meta name="apple-mobile-web-app-title" content="La Pizzeria Restaurant" />
       <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() . "/img/apple-touch-icon.jpg" ?>" />
       <?php wp_head(); ?>





      </head>



      <body <?php body_class(); ?>>

              <header class="site-header">
                <div class="container">

                      <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                          <img src="<?php echo get_template_directory_uri() . "/img/logo.svg" ?>" class="logoimage">
                        </a>
                      </div>

                      <div class="header-information">
                        <div class="socials">

                          <?php
                            $args = array(
                              'theme_location' => 'social-menu',
                              'container' => 'nav',
                              'container_class' => 'socials',
                              'container_id' => 'socials',
                              'link_before' => '<span class="sr-text">',
                              'link_after' => '</span>'
                            );
                            wp_nav_menu($args);

                           ?>

                        </div> <!-- socials -->
                        <div class="address">
                          <p><?php echo get_theme_mod('custom_address');?></p>
                          <p>Phone : <?php echo get_theme_mod('phone_number'); ?></p>

                        </div> <!-- address -->
                      </div>

                    </div> <!-- container -->
              </header>

      <div class="main-menu">

                <div class="mobile-menu">

                    <a href="#" class="mobile"><i class="fa fa-bars"></i> Menu</a>

                </div>

                <div class="navigation container">

                    <?php
                      $arg = array(
                        'theme_location' => 'header-menu',
                        'container' => 'nav',
                        'container_class' => 'site-nav'
                      );
                      wp_nav_menu($arg);

                       ?>

                </div>



      </div> <!-- navigation container -->
