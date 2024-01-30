<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendNotificationWhatsappKlinikoo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-notification-whatsapp:klinikoo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification WA to Klinikoo';

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
     * @return int
     */
    public function handle()
    {
        \Log::info("Send Message! - START");
        \Log::info("Send Message! - END");
    }
}
