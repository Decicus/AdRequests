<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Request;

class ChangeRequestOwner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'request:ownerchange {request_id} {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Changes the request owner to the username specified.';

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
        $id = $this->argument('request_id');
        $username = strtolower($this->argument('username'));

        $request = Request::where(['id' => $id])->first();

        if (empty($request)) {
            return $this->error('The specified request does not exist: ' . $id);
        }

        $user = User::where(['name' => $username])->first();

        if (empty($user)) {
            return $this->error('The specified user does not exist: '. $username);
        }

        $confirm = 'Are you sure you want to update the owner to %s for the request: "%s"';
        if ($this->confirm(sprintf($confirm, $user->nickname, $request->name))) {
            $request->user_id = $user->id;
            $request->save();

            $message = 'The user %s is now the owner of the request: "%s"';
            return $this->info(sprintf($message, $user->nickname, $request->name));
        }

        return $this->info('Aborted.');
    }
}
