<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class RemoveTwitchRelation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:twitchremove {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes a Twitch account relation for the specified reddit account.';

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

        $user = User::where(['name' => $name])->first();

        if (empty($user)) {
            return $this->error('User does not exist: ' . $name);
        }

        if (empty($user->twitch)) {
            return $this->error('User does not have any Twitch account connected: ' . $name);
        }

        $relation = $user->twitch;
        $removeText = 'Are you sure you want to remove this connection? Requests by %s will not include the Twitch username %s anymore.';
        if ($this->confirm(sprintf($removeText, $user->nickname, $relation->nickname))) {
            $relation->delete();
            $end = 'Twitch account connection for user %s has been REMOVED.';
        } else {
            $end = 'Twitch account connection for user %s is UNAFFECTED.';
        }

        return $this->info(sprintf($end, $user->nickname));
    }
}
