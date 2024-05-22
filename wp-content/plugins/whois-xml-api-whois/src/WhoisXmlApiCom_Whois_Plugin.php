<?php

require_once plugin_dir_path( __FILE__ ) . '/WhoisXmlApiCom_Whois_Settings.php';
require_once plugin_dir_path( __FILE__ ) . '/WhoisXmlApiCom_Whois_Bad_Tlds.php';



if( !class_exists ('WhoisXmlApiCom_Whois_Plugin') ){
    class WhoisXmlApiCom_Whois_Plugin
    {
        const TARGET_KEY    = 'links_target';
        const TARGET_BLANK  = '_blank';
        const TARGET_SELF   = '_self';


        protected $target = true;
        protected $unique = false;
        protected $comment = false;

        protected $processedDomains = array();

        public function __construct()
        {
            $this->init_options();
            add_action(
                'the_content',
                array( $this, 'update_post_content' ),
                10
            );
            if ( $this->comment ) {
                add_action(
                    'comment_text',
                    array($this, 'update_comment_content'),
                    10
                );
            }
        }

        public function update_comment_content($comment_text)
        {
            return $this->update_content($comment_text);
        }

        public function update_post_content($post_content)
        {
            return $this->update_content($post_content);
        }

        protected function update_content($content)
        {
            $line = preg_replace_callback(
                '/(^|>|\s)+(([a-zA-Z0-9][a-zA-Z0-9-]{0,64}\.){1,10}[a-zA-Z][a-zA-Z0-9]{1,63})/',
                array($this, 'handler'),
                $content
            );

            return $line;
        }

        public function handler($matches)
        {
            $line = preg_replace_callback(
                '/(([a-zA-Z0-9]{1,1}[a-zA-Z0-9-]{0,64}\.){1,10}[a-zA-Z0-9]{2,64})/',
                array($this, 'wrap_domain'),
                $matches[0]
            );


            return $line;
        }

        public function wrap_domain($matches)
        {
            $domain = $matches[0];

            $targetValue = $this->target ? static::TARGET_BLANK : static::TARGET_SELF;

            if ($this->unique) {
                if (isset($this->processedDomains[$domain])) {
                    return $domain;
                }
                $this->processedDomains[$domain] = true;
            }

            if (!$this->is_tld_valid($domain)) {
                return $domain;
            }

            return '<span class="whoisxmlapicom-whois-element" data-loaded="false" data-target="' . $targetValue . '">'
                . $domain
                . '</span>';
        }


        protected function init_options()
        {
            $options = get_option(WhoisXmlApiCom_Whois_Settings::OPTIONS_NAME);

            if (isset($options['links_target'])) {
                $this->target = boolval($options['links_target']);
            }
            if (isset($options['unique'])) {
                $this->unique = boolval($options['unique']);
            }
            if (isset($options['comment'])) {
                $this->comment = boolval($options['comment']);
            }
        }

        protected function is_tld_valid($domain)
        {
            $parts = explode('.', $domain);

            $tld = $parts[count($parts) - 1];

            if (in_array($tld, WhoisXmlApiCom_Whois_Bad_Tlds::get())) {
                return false;
            }

            return true;
        }
    }
}