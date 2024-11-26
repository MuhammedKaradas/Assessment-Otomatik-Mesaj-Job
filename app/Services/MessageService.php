<?php

namespace App\Services;

use App\Models\Message;
use App\Repositories\MessageRepository;
use Illuminate\Database\Eloquent\Collection;

class MessageService
{

    public function __construct(private readonly MessageRepository $messageRepository)
    {
    }

    public function all(): Collection
    {
        return $this->messageRepository->all();
    }

    public function allUnsent(): Collection
    {
        return $this->messageRepository->allUnsent();
    }

    public function find(int $id): Message
    {
        return $this->messageRepository->find($id);
    }

    public function create(array $data): Message
    {
        return $this->messageRepository->create($data);
    }

    public function update(array $data, int $id): Message
    {
        return $this->messageRepository->update($data, $id);
    }

    public function delete(int $id): Message
    {
        return $this->messageRepository->delete($id);
    }

}
