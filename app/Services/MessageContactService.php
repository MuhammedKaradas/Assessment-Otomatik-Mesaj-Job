<?php

namespace App\Services;

use App\Models\MessageContact;
use App\Repositories\MessageContactRepository;
use Illuminate\Database\Eloquent\Collection;

class MessageContactService
{

    public function __construct(private readonly MessageContactRepository $contactRepository)
    {
    }

    public function all(): Collection
    {
        return $this->contactRepository->all();
    }

    public function find(int $id): MessageContact
    {
        return $this->contactRepository->find($id);
    }

    public function create(array $data): MessageContact
    {
        return $this->contactRepository->create($data);
    }

    public function update(array $data, int $id): MessageContact
    {
        return $this->contactRepository->update($data, $id);
    }

    public function delete(int $id): MessageContact
    {
        return $this->contactRepository->delete($id);
    }

}
