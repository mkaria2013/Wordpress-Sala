<?php

/*
Plugin Name:  Whois XML API Whois
Description:  Add WHOIS info for domain names in post text and comments
Version:      1.0.2
Author:       Whois XML API, LLC
Author URI:   https://whoisapi.whoisxmlapi.com/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  whois-xml-api-whois
*/


defined('ABSPATH') or die('Not allowed');

require_once plugin_dir_path( __FILE__ ) . '/src/WhoisXmlApiCom_Whois_Plugin.php';
require_once plugin_dir_path( __FILE__ ) . '/src/WhoisXmlApiCom_Whois_Settings.php';


$whois_xml_api_whois_core = new WhoisXmlApiCom_Whois_Plugin();

add_action('wp_enqueue_scripts', 'whoisxmlapicom_whois_add_scripts');
add_action('wp_enqueue_scripts', 'whoisxmlapicom_whois_add_styles');

if ( !function_exists( 'whoixmapicom_whois_add_scripts' ) ) {
    function whoisxmlapicom_whois_add_scripts()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script(
            'whoisxmlapicom-whois-tooltipster-js',
            plugins_url(
                '/js/whoisxmlapicom-whois-tooltipster.js',
                __FILE__
            )
        );
        wp_enqueue_script(
            'whoisxmlapicom-whois-plugin',
            plugins_url(
                '/js/whoisxmlapicom-whois-plugin.js',
                __FILE__
            )
        );
    }
}

if ( !function_exists( 'whoisxmlapicom_whois_add_styles' ) ) {
    function whoisxmlapicom_whois_add_styles()
    {
        wp_enqueue_style(
            'whoisxmlapicom-whois-plugin-styles',
            plugins_url( '/css/whoisxmlapicom-whois-plugin.css',
                __FILE__
            )
        );
        wp_enqueue_style(
            'whoisxmlapicom-whois-tooltipster-css',
            plugins_url(
                '/css/whoisxmlapicom-whois-tooltipster.css',
                __FILE__
            )
        );
        wp_enqueue_style(
            'whoisxmlapicom-whois-tooltipster-light-css',
            plugins_url(
                '/css/whoisxmlapicom-whois-tooltipster-light.css',
                __FILE__
            )
        );
    }
}

if( is_admin() )
    $whois_xml_api_whois_settings_page = new WhoisXmlApiCom_Whois_Settings();