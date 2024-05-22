<?php


if ( !class_exists('WhoisXmlApiCom_Whois_Settings') ) {
    class WhoisXmlApiCom_Whois_Settings
    {
        const GROUP = 'whoisxmlapicom-whois-options-group';
        const OPTIONS_NAME = 'whoisxmlapicom-whois-option';
        const SETTINGS_SECTION = 'whoisxmlapicom-whois-settings';
        const PAGE_NAME = 'whoisxmlapicom-whois-settings-page';

        protected $options;


        public function __construct()
        {
            add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
            add_action( 'admin_init', array( $this, 'page_init' ) );
        }

        public function add_plugin_page()
        {
            // This page will be under "Settings"
            add_options_page(
                'Whois XML API Whois integration settings',
                'Whois XML API Whois settings',
                'manage_options',
                'whoisxmlapicom-whois-plugin',
                array( $this, 'create_admin_page' )
            );
        }

        public function create_admin_page()
        {
            // Set class property
            $this->options = get_option(static::OPTIONS_NAME);
            ?>
            <div class="wrap">
                <h1>Plugin settings</h1>
                <form method="post" action="options.php">
                    <?php
                    // This prints out all hidden setting fields
                    settings_fields( static::GROUP );
                    do_settings_sections(static::PAGE_NAME);
                    submit_button();
                    ?>
                </form>
            </div>
            <?php
        }

        public function page_init()
        {

            register_setting(
                static::GROUP,
                static::OPTIONS_NAME,
                array(
                    'sanitize_callback' => array(
                        $this, 'sanitize'
                    )
                )
            );

            add_settings_section(
                static::SETTINGS_SECTION,
                'Whois XML API Whois plugin settings',
                array( $this, 'print_section_info' ),
                static::PAGE_NAME
            );

            add_settings_field(
                'links_target',
                'Open report in new window',
                array( $this, 'links_target_callback' ),
                static::PAGE_NAME,
                static::SETTINGS_SECTION
            );

            add_settings_field(
                'unique',
                'Process only unique domains',
                array( $this, 'unique_callback' ),
                static::PAGE_NAME,
                static::SETTINGS_SECTION
            );

            add_settings_field(
                'comment',
                'Process domains in comments',
                array( $this, 'comment_callback' ),
                static::PAGE_NAME,
                static::SETTINGS_SECTION
            );
        }

        public function sanitize( $input )
        {
            $new_input = array();
            $new_input['links_target'] = isset( $input['links_target'] ) ?
                true : false;

            $new_input['unique'] = isset( $input['unique'] ) ?
                true : false;

            $new_input['comment'] = isset( $input['comment'] ) ?
                true : false;

            return $new_input;
        }

        public function print_section_info()
        {
            print 'Configure the plugin using settings below:';
        }

        public function links_target_callback()
        {
            printf(
                '<input type="checkbox" id="links_target" name="%s[links_target]" %s />',
                static::OPTIONS_NAME,
                isset( $this->options['links_target'] )
                    ? ( ( $this->options['links_target'] ) ? 'checked' : '' ): 'checked'
            );
        }

        public function unique_callback()
        {
            printf(
                '<input type="checkbox" id="unique" name="%s[unique]" value="unique" %s />',
                static::OPTIONS_NAME,
                isset( $this->options['unique'] )
                    ? ( ( $this->options['unique'] ) ? 'checked' : '' ) : ''
            );
        }

        public function comment_callback()
        {
            printf(
                '<input type="checkbox" id="comment" name="%s[comment]" value="comment" %s />',
                static::OPTIONS_NAME,
                isset( $this->options['comment'] )
                    ? ( ( $this->options['comment'] ) ? 'checked' : '' ): ''
            );
        }
    }
}
