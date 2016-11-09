<?php

use Illuminate\Database\Seeder;
use App\Request;
use App\User;

class SampleRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $samples = [
            [
                'type' => 3,
                'body' => [
                    'name' => 'Twitch Log Bot',
                    'url' => 'https://github.com/Decicus/twitch-log-bot',
                    'description' => 'It logs chats of Twitch channels to Google Cloud Datastore.',
                    'user_data' => 'Technically none, as the bot is hosted locally, although the configuration requires a Google Cloud Datastore "subscription".',
                    'api' => '0',
                    'api_data' => '',
                    'api_scopes' => '',
                    'api_scopes_description' => '',
                    'tos' => '0',
                    'tos_url' => '',
                    'open_source' => '1',
                    'open_source_url' => 'https://github.com/Decicus/twitch-log-bot',
                    'beta' => '0',
                    'beta_description' => ''
                ],
                'approval' => 0
            ],
            [
                'type' => 5,
                'body' => [
                    'name' => 'Cactus Industries',
                    'product_name' => 'Prick-A-Friend™',
                    'permissions' => '1',
                    'tos' => '0',
                    'tos_url' => '',
                    'user_data' => 'Everything.',
                    'date' => '2020-01-01',
                    'days' => '90'
                ],
                'approval' => 0
            ],
            [
                'type' => 2,
                'body' => [
                    'name' => 'DecAPI',
                    'url' => 'https://decapi.me/',
                    'description' => 'DecAPI is an API service for developers or "bot masters" to use for different stats. It is able to retrieve information such as stream uptime, follower count, subscriber count (with authorization from the broadcaster), latest tweet, latest YouTube video and a lot of other things.',
                    'user_data' => 'Generally nothing, although sometimes Twitch authentication is required for certain endpoints.',
                    'api' => '1',
                    'api_data' => 'Access tokens for authenticating with for example "subcount".',
                    'api_scopes' => 'Generally: user_read, channel_subscriptions',
                    'api_scopes_description' => 'user_read is just for general authentication of the user.
                    channel_subscriptions is required for the API endpoint that has the subscriber count.',
                    'tos' => '0',
                    'tos_url' => '',
                    'open_source' => '1',
                    'open_source_url' => 'https://github.com/Decicus/DecAPI',
                    'beta' => '0',
                    'beta_description' => ''
                ],
                'approval' => 1
            ],
            [
                'type' => 4,
                'body' => [
                    'name' => 'decicus',
                    'partnered' => 0,
                    'viewers' => 7,
                    'host' => 'Because I\'m cool.',
                    'why' => 'Because I\'m really, really cool. Kappa / Hey',
                    'focus' => 'Scrubbing toilets.',
                    'background' => 'Ice cube.',
                    'date' => '2039-12-31',
                    'days' => 3652
                ],
                'approval' => 1
            ],
            [
                'type' => 6,
                'body' => [
                    'name' => 'Has anyone really been far even as decided to use even go want to do look more like?',
                    'description' => 'Has anyone really been far even as decided to use even go want to do look more like?'
                ],
                'approval' => 2
            ],
            [
                'type' => 1,
                'body' => [
                    'name' => "Beers with The Blacklist - PAX West 2016",
                    'url' => "https://www.youtube.com/watch?v=V35re_FenYY",
                    'owner' => 0,
                    'description' => 'It\'s a video from a livestream of a community party during PAX West 2016.'
                ],
                'approval' => 2
            ]
        ];

        $user = [
            'id' => '7rlz1',
            'name' => 'decicus',
            'nickname' => 'Decicus'
        ];
        $account = User::firstOrCreate($user);
        $account->admin = 1;
        $account->save();

        foreach ($samples as $s) {
            $request = Request::add($s['type'], $s['body']);
            $request->user_id = $user['id'];
            $request->approval_id = $s['approval'];
            $request->save();
        }
    }
}
