<?php

namespace App\Services;

use App\Models\MessageTemplate;
use App\Repositories\MessageTemplateRepository;
use Illuminate\Database\Eloquent\Collection;

class MessageTemplateService
{

    public function __construct(private readonly MessageTemplateRepository $templateRepository)
    {
    }

    public function all(): Collection
    {
        return $this->templateRepository->all();
    }

    public function find(int $id): MessageTemplate
    {
        return $this->templateRepository->find($id);
    }

    public function findCode(string $code): MessageTemplate
    {
        return $this->templateRepository->findCode($code);
    }

    public function create(array $data): MessageTemplate
    {
        return $this->templateRepository->create($data);
    }

    public function update(array $data, int $id): MessageTemplate
    {
        return $this->templateRepository->update($data, $id);
    }

    public function delete(int $id): MessageTemplate
    {
        return $this->templateRepository->delete($id);
    }

}
