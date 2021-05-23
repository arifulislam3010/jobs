<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sendmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmail:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email subscriber';

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
        $this->info("ok");
    }
}
