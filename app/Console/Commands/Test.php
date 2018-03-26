<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class Test extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'larabbs:test {uid}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
        $uid = $this->argument('uid');
        $user = User::find($uid);
        $user->delete();

	}
}
