<?php

namespace App\Interfaces;

use App\Models\MessageTemplate;
use Illuminate\Database\Eloquent\Collection;


interface MessageTemplateInterface
{
    public function all(): Collection;
    public function find(int $id): MessageTemplate;
    public function create(array $data): MessageTemplate;
    public function update(array $data, int $id): MessageTemplate;
    public function delete(int $id): MessageTemplate;

}
