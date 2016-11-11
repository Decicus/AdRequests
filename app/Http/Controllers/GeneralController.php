<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use GuzzleHttp\Client;

class GeneralController extends Controller
{
    /**
     * The homepage view
     *
     * @return Response
     */
    public function home()
    {
        return view('general.home', [
            'page' => 'Home'
        ]);
    }

    /**
     * Redirect /login to the real authentication URL.
     *
     * @return Response
     */
    public function login()
    {
        return redirect()->route('auth.reddit.redirect');
    }

    /**
     * Proxies images passed in Markdown.
     *
     * @param  Request $request
     * @return Response
     */
    public function imageProxy(Request $request)
    {
        /**
         * LUL.
         *
         * @var string
         */
        $default = 'https://cdn.betterttv.net/emote/567b00c61ddbe1786688a633/3x';
        $url = $request->input('url', $default);

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $url = $default;
        }

        $client = new Client;
        $request = $client->request('GET', $url, [
            'http_errors' => false,
            'headers' => [
                'User-Agent' => 'AdRequestsProxy 1.0.0'
            ]
        ]);

        $typeHeader = $request->getHeader('Content-Type');
        $type = 'image/png';

        if (!empty($typeHeader)) {
            $type = $typeHeader[0];
        }

        return response($request->getBody(), 200)->withHeaders([
            'Content-Type' => $type
        ]);
    }
}
