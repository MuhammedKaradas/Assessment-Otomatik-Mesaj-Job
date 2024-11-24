<?php

namespace App\Repositories;

use App\Interfaces\MessageContactInterface;
use App\Models\MessageContact;
use Illuminate\Database\Eloquent\Collection;

class MessageContactRepository implements MessageContactInterface
{

    public function all(): Collection
    {
        return MessageContact::query()->latest()->get();
    }

    public function find(int $id): MessageContact
    {
        return MessageContact::query()->findOrFail($id);
    }

    public function create(array $data): MessageContact
    {
        return MessageContact::create($data);
    }

    public function update(array $data, int $id): MessageContact
    {
        $contact = MessageContact::query()->findOrFail($id);
        $contact->update($data);
        return $contact;
    }

    public function delete(int $id): MessageContact
    {
        $contact = MessageContact::query()->findOrFail($id);
        $contact->delete();
        return $contact;
    }

}
