<?php

if ( !class_exists('WhoisXmlApiCom_Whois_Bad_Tlds') ) {
    class WhoisXmlApiCom_Whois_Bad_Tlds
    {
        static public function get()
        {
            return array(
                'txt',
                'php',
                'jpg',
                'png',
                'jpeg',
                'exe',
                'gif',
                'doc',
                'docx',
                'ppt',
                'pptx',
                'xls',
                'xlsx',
                'java',
                'sh',
                'bat',
            );
        }
    }
}