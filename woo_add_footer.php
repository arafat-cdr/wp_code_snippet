<?php

function custom_scripts_footer() {
    ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/custom-script.js"></script>
    <?php
}
add_action( 'wp_footer', 'custom_scripts_footer' );