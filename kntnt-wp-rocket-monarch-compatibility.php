<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt compatibility plugin for WP-Rocket and Monarch
 * Plugin URI:        https://www.kntnt.com/
 * Description:       Exclude Monarch's CSS to be cached by WP-Rocket.
 * Version:           1.0.1
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace Kntnt\WP_Rocket_Monarch_Compatibility;

defined('WPINC') || die;

new Plugin;

final class Plugin {

    private $file;

    public function __construct() {

        $wp_dir = rtrim(strtr(ABSPATH, '\\', '/'), '/');
        $site_dir = strtr($_SERVER['DOCUMENT_ROOT'], '\\', '/');
        $wp_dir_rel_site = substr($wp_dir, strlen($site_dir));
        $this->file = "$wp_dir_rel_site/wp-content/plugins/monarch/css/style.css";

        add_filter('rocket_exclude_css', [$this, 'exclude']);
        add_filter('rocket_exclude_cache_busting', [$this, 'exclude']);

    }

    public function exclude($exclude_files) {
        $exclude_files[] = $this->file;
        return $exclude_files;
    }

}
