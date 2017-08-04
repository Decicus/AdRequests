# Ad Requests
Ad Requests was a project originally written by [Heep123 in node.js, using RethinkDB](https://github.com/Heep123/AdRequests), but was eventually considered 'deprecated' due to [RethinkDB shutting down](https://www.rethinkdb.com/blog/rethinkdb-shutdown/).

This is a rewrite in PHP using Laravel 5.3, which is aimed to support all the past features and possibly more.

## Requirements
- [Laravel 5.3's requirements](https://laravel.com/docs/5.3/installation#server-requirements)
- [Composer for PHP](https://getcomposer.org/)
- [A Reddit developer app](https://www.reddit.com/prefs/apps/)
- [A Twitch developer app](https://www.twitch.tv/settings/connections)
- A Slack webhook (if you want a notification when a new AdRequest is posted).

## Setup
Coming soon&trade;

#### Quick runthrough:
1. Copy `.env.example` to `.env`.
2. Open `.env` and set database values, reddit/Twitch developer app values, site title, `APP_DEBUG=false` etc.
3. Run `composer install` in the AdRequests directory.
4. Once that's finished, run `php artisan migrate` and `php artisan db:seed`.
5. Log into the AdRequests system with your reddit account
6. Run `php artisan user:admin YOUR_REDDIT_USERNAME` to make yourself an admin.

## Credits
- [Heep123](https://github.com/Heep123) for the original idea.
