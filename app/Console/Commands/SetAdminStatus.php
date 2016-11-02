<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class SetAdminStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:admin {username} {--remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Finds a user by their Reddit username and sets their admin status.';

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
        $isAdmin = !$this->option('remove');

        $user = User::where(['name' => $name])->first();

        if (empty($user)) {
            return $this->error('User does not exist: ' . $name);
        }
        
        $user->admin = $isAdmin;
        $user->save();
        $format = "User %s's admin status has been set to: %s";
        $status = $isAdmin ? 'true' : 'false';

        return $this->info(sprintf($format, $name, $status));
    }
}
