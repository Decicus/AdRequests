<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class GenerateApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:apitoken {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a fresh API token for the specified reddit user.';

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
        $name = strtolower($this->argument('username'));

        $user = User::where('name', $name)->first();

        if (empty($user)) {
            return $this->error('User does not exist: ' . $name);
        }

        $token = str_random(60);
        $user->api_token = $token;
        $user->save();

        $format = "Generated new API token for '%s': %s";
        return $this->info(sprintf($format, $name, $token));
    }
}
