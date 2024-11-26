<?php

namespace App\Repositories;

use App\Interfaces\MessageInterface;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository implements MessageInterface
{

    public function all(): Collection
    {
        return Message::query()->latest()->get();
    }

    public function allUnsent(): Collection
    {
        return Message::query()->whereNull('sent_date')->get();
    }

    public function find(int $id): Message
    {
        return Message::query()->findOrFail($id);
    }

    public function create(array $data): Message
    {
        return Message::create($data);
    }

    public function update(array $data, int $id): Message
    {
        $message = Message::query()->findOrFail($id);
        $message->update($data);
        return $message;
    }

    public function delete(int $id): Message
    {
        $message = Message::query()->findOrFail($id);
        $message->delete();
        return $message;
    }

}
