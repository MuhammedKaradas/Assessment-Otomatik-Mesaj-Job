<?php

namespace App\Repositories;

use App\Interfaces\MessageTemplateInterface;
use App\Models\MessageTemplate;
use Illuminate\Database\Eloquent\Collection;

class MessageTemplateRepository implements MessageTemplateInterface
{

    public function all(): Collection
    {
        return MessageTemplate::query()->latest()->get();
    }

    public function find(int $id): MessageTemplate
    {
        return MessageTemplate::query()->findOrFail($id);
    }

    public function create(array $data): MessageTemplate
    {
        return MessageTemplate::create($data);
    }

    public function update(array $data, int $id): MessageTemplate
    {
        $template = MessageTemplate::query()->findOrFail($id);
        $template->update($data);
        return $template;
    }

    public function delete(int $id): MessageTemplate
    {
        $template = MessageTemplate::query()->findOrFail($id);
        $template->delete();
        return $template;
    }

}
