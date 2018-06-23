    <footer>

        <?php

            $args = array(

                     'theme_location' => 'header-menu',
                     'container' => 'nav',
                     'after' => '<span class="separator"> | </span>'
            );
            wp_nav_menu($args);

        ?>

        <div class="location">
            <p><?php echo get_theme_mod('custom_address'); ?></p>
        </div>

        <div class="copyright">
            <p><?php echo get_theme_mod('custom_copyright_section_text','$copy; LaPizzeria 2017. All Rights Reserved'); ?></p>
        </div>

    </footer>

    <?php wp_footer(); ?>
</body>
</html>
