<?php

/**
 * @param $chanel
 * @param $text
 * @param bool $notification
 * @return bool|string
 */

if( !function_exists('send_message_to_slack') ) {
    function send_message_to_slack( $chanel, $text, $notification = false ) {
        $url = $notification ? 'https://slack.com/api/chat.postMessage' : 'https://slack.com/api/chat.meMessage';
        $res = wp_remote_get( $url, [

            'headers'      => [
                'Content-Type' => 'application/json; charset=utf-8'
            ],
            'body'         => [
                'token'    =>  'xxxxxx',
                'channel'  => $chanel,
                'text'     => $text,
            ]

        ]);

        if ( is_wp_error( $res ) ){
            return $res->get_error_message();
        }elseif( wp_remote_retrieve_response_code( $res ) === 200 ){
            return true;
        }

    }
}


/**
 * @param $chanel
 * @param $text
 * @param $filename
 * @param $filetype
 * @return bool|string
 */

if( !function_exists('send_file_to_slack') ) {
    function send_file_to_slack( $chanel, $text, $filename, $filetype ) {
        $url = 'https://slack.com/api/files.upload';
        $res = wp_remote_get( $url, [

            'headers'      => [
                'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8'
            ],
            'body'         => [
                'token'    =>  'xxxxxx',
                'channels' => $chanel,
                'content'  => $text,
                'filename' => $filename,
                'filetype' => $filetype
            ]

        ]);

        if ( is_wp_error( $res ) ){
            return $res->get_error_message();
        }elseif( wp_remote_retrieve_response_code( $res ) === 200 ){
            return true;
        }

    }
}