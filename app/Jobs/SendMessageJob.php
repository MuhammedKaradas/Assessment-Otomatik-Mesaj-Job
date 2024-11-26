<?php

namespace App\Jobs;

use App\Enums\MessageStatus;
use App\Models\Message;
use App\Services\MessageContactService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Services\MessageService;
use App\Services\MessageSendService;
use App\Services\MessageTemplateService;
use Illuminate\Database\Eloquent\Collection;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $messages;

    /**
     * Create a new job instance.
     */
    public function __construct(Collection  $_messages)
    {
        $this->messages = $_messages;
    }

    /**
     * Execute the job.
     */
    public function handle(MessageSendService $sendService, MessageService $messageService, MessageTemplateService $templateService, MessageContactService $contactService): void
    {

        try {

            foreach($this->messages as $message) {
                $message->queue_send_date = now();
                $messageService->update($message->toArray(), $message->id);

                $template = $templateService->find($message->template_id);
                $contact = $contactService->find($message->contact_id);

                $fullMessage = $template->template_message;
                if (Str::length($fullMessage) > env('MESSAGE_CHARACTER_COUNT', 150)) {
                    $message->status = MessageStatus::CHARACTER_LIMIT_EXCEEDED;
                    $messageService->update($message->toArray(), $message->id);
                    return;
                }

                $fullName = $contact->name. " ". $contact->surname;
                $phone = "+".$contact->area_code.$contact->phone_number;

                $result = $sendService->sendMessage($phone, $fullMessage);

                if($result) {
                    $infoLog = $fullName. " isimli kişinin ".$phone." numarasına ".$template->template_code. " kodlu şablon mesajı gönderilmiştir. Mesaj İçeriği: ". $fullMessage;
                    echo $infoLog;
                    Log::info($infoLog);
                    $message->status = MessageStatus::SENT;
                    $message->unique_message_id = random_int(1000000000, 2147483647);
                    $message->sent_date = now();
                    $messageService->update($message->toArray(), $message->id);
                } else {
                    $infoWarn = "Mesaj gönderimi başarısız! Telefon Bilgisi: ".$phone;
                    echo $infoWarn;
                    Log::info($infoWarn);
                    $message->status = MessageStatus::FAILED;
                    $messageService->update($message->toArray(), $message->id);
                }

                sleep(2);

            }


        } catch(\Exception $e) {
            echo "Mesaj gönderimi hata aldı! Hata: " . $e->getMessage();
            Log::error('Mesaj gönderimi hata aldı', [
                'error' => $e->getMessage(),
            ]);
            $message->status = MessageStatus::FAILED;
            $messageService->update($message->toArray(), $message->id);
        }

    }
}
