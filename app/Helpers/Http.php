<?php

namespace App\Helpers;

class Http
{
    /**
     * Returns a JSON response with specified headers
     *
     * @param  array  $data
     * @param  integer $code    HTTP status code
     * @param  array  $headers HTTP headers
     * @return response
     */
    public static function json($data = [], $code = 200, $headers = [])
    {
        $headers['Access-Control-Allow-Origin'] = '*';

        return \Response::json($data, $code)->withHeaders($headers);
    }

    /**
     * Returns a plaintext response with set headers
     *
     * @param  string  $text    Text to send
     * @param  integer $code    HTTP status code
     * @param  array   $headers HTTP headers
     * @return response
     */
    public static function text($text = '', $code = 200, $headers = [])
    {
        $headers['Content-Type'] = 'text/plain';
        $headers['Access-Control-Allow-Origin'] = '*';
        return response($text, $code)->withHeaders($headers);
    }
}
