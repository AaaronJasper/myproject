<?php

namespace App\Console\Commands;

use App\Mail\UserSubscribedMessage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestAutoUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Mail::to("davis@gmail.com")->send(new UserSubscribedMessage());
    }
}
