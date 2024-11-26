<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MessageService;
use App\Jobs\SendMessageJob;

class SendMessagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(MessageService $messageService)
    {
        $messages = $messageService->allUnsent();

        if ($messages->isNotEmpty()) {
            dispatch(new \App\Jobs\SendMessageJob($messages));
            $this->info('Mesaj gönderme işi kuyruğa alındı.');
        } else {
            $this->info('Queue da Herhangi Bir Mesaj Bulunmadığından Job Sonlandırıldı.');
        }
    }
}
