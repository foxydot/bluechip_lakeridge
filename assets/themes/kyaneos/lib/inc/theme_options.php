<?php

/**
 * Theme Options
 *
 * @package      Kyaneos
 * @author       MSDLab
 * @copyright    Copyright (c) 2015, Mad Science Dept.
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */


/**
 * Register Defaults
 * @author MSD Lab
 *
 * @param array $defaults
 * @return array modified defaults
 *
 */

function msdlab_kyaneos_defaults( $defaults ) {

    $defaults['color'] = '';

    return $defaults;
}
add_filter( 'genesis_theme_settings_defaults', 'msdlab_kyaneos_defaults' );


/**
 * Sanitization
 * @author MSD Lab
 *
 */

function msdlab_register_kyaneos_sanitization_filters() {
    genesis_add_option_filter( 'no_html', GENESIS_SETTINGS_FIELD,
        array(
            'color',
        ) );
}
add_action( 'genesis_settings_sanitizer_init', 'msdlab_register_kyaneos_sanitization_filters' );


/**
 * Register Metabox
 * @author MSD Lab
 *
 * @param string $_genesis_theme_settings_pagehook
 */

function msdlab_register_kyaneos_settings_box( $_genesis_theme_settings_pagehook ) {
    add_meta_box('msdlab-kyaneos-settings', 'Kyanos Settings', 'msdlab_kyaneos_settings_box', $_genesis_theme_settings_pagehook, 'main', 'high');
}
add_action('genesis_theme_settings_metaboxes', 'msdlab_register_kyaneos_settings_box');

/**
 * Create Metabox
 * @author MSD Lab
 *
 */

function msdlab_kyaneos_settings_box() {
    $color = esc_attr( genesis_get_option('color') );
    $logo = esc_attr( genesis_get_option('logo') );
    ?>
    <div>
        <label>Color Scheme</label>
        <select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[color]">
            <option value="blue"<?php print $color == 'blue'?' selected':''; ?>>Blue</option>
            <option value="green"<?php print $color == 'green'?' selected':''; ?>>Green</option>
            <option value="purple"<?php print $color == 'purple'?' selected':''; ?>>Purple</option>
        </select>
    </div>
    <?php
}


add_filter('body_class','msdlab_kyaneos_settings_body_class');
function msdlab_kyaneos_settings_body_class($classes) {
    $classes[] = 'kyaneos-'.esc_attr( genesis_get_option('color') );
    return $classes;
}