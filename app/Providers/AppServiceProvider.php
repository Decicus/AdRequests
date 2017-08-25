<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Request;
use Exception;
use Log;
use Slack;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!empty(env('SLACK_ENDPOINT'))) {
            Request::created(function ($request) {
                $user = $request->user;
                $header = [
                    '*New AdRequest posted!*'
                ];

                $msg = [];
                $msg[] = 'Username: ' . $user->nickname;

                if ($user->twitch) {
                    $msg[] = 'Twitch name: ' . $user->twitch->nickname;
                }

                $msg[] = 'Title/name: ' . json_decode($request->body, true)['name'];
                $msg[] = 'Type: ' . $request->type->full_title;
                $msg[] = 'URL: ' . route('requests.id', $request->id);

                try {
                    Slack::send(sprintf('%s %s ```%s```', implode($header, PHP_EOL), PHP_EOL, implode($msg, PHP_EOL)));
                } catch (Exception $ex) {
                    Log::error($ex->getMessage());
                }
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
