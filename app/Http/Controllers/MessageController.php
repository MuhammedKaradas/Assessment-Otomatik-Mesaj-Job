<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessageJob;
use App\Services\MessageService;
use App\Services\MessageTemplateService;
use App\Services\MessageContactService;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    private MessageService $messageService;


    public function __construct(private readonly MessageService $_messageService)
    {
        $this->messageService = $_messageService;
    }

    public function index()
    {
        return $this->messageService->all();
    }

    public function show(string $id)
    {
        return $this->messageService->find($id);
    }

    public function store(Request $request)
    {
        return $this->messageService->create($request->all());
    }

    public function update(Request $request, int $id)
    {
        return $this->messageService->update($request->all(), $id);
    }

    public function destroy(int $id)
    {
        return $this->messageService->delete($id);
    }

    //Custom Methods

    public function sendMessages()
    {
        $messages = $this->messageService->allUnsent();

        if($messages->isNotEmpty() && count($messages) > 0) {
            SendMessageJob::dispatch($messages);
            return response()->json(['message' => 'Mesajlar Başarılı Şekilde Gönderildi.'], 200);
        } else {
            return response()->json(['message' => 'Queue da Herhangi Bir Mesaj Bulunmadığından Job Sonlandırıldı.'], 200);
        }

    }

}
