<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use App\User;

class ForceLoadUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:forceload {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Allows you to "force load" the user into the database with the Reddit ID and username.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $username = strtolower($this->argument('username'));

        $check = User::where(['name' => $username])->first();

        if (!empty($check)) {
            return $this->error('User already exists: ' . $username);
        }

        $client = new Client;
        $result = $client->request('GET', 'https://api.reddit.com/user/' . $username . '/about', [
            'http_errors' => false,
            'headers' => [
                'User-Agent' => 'Decicus/AdRequests 1.0.0'
            ]
        ]);

        $body = json_decode($result->getBody(), true);

        $user = User::firstOrCreate([
            'id' => $body['data']['id'],
            'name' => $username,
            'nickname' => $body['data']['name']
        ]);

        $user->save();
        return $this->info('User added to database: ' . $username);
    }
}
