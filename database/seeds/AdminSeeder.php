<?php

use Illuminate\Database\Seeder;
use App\User;
use GuzzleHttp\Client;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client;
        $result = $client->request('GET', 'https://api.reddit.com/r/twitch/about/moderators', [
            'http_errors' => false,
            'headers' => [
                'User-Agent' => 'Decicus/AdRequests 1.0.0'
            ]
        ]);

        $body = json_decode($result->getBody(), true);

        foreach ($body['data']['children'] as $user) {
            $perms = $user['mod_permissions'];
            if ($perms[0] !== 'all' && count($perms) === 1) {
                continue;
            }

            $id = str_replace('t2_', null, $user['id']);
            $account = User::firstOrCreate([
                'id' => $id,
                'name' => strtolower($user['name']),
                'nickname' => $user['name']
            ]);

            $account->admin = 1;
            $account->save();
        }
    }
}
