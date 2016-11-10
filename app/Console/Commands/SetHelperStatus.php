<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class SetHelperStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:helper {username} {--remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Finds a user by their Reddit username and sets their helper status.';

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
        $isHelper = !$this->option('remove');

        $user = User::where(['name' => $name])->first();

        if (empty($user)) {
            return $this->error('User does not exist: ' . $name);
        }

        $user->helper = $isHelper;
        $user->save();
        $format = "User %s's helper status has been set to: %s";
        $status = $isHelper ? 'true' : 'false';

        return $this->info(sprintf($format, $name, $status));
    }
}
