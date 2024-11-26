<?php

namespace App\Interfaces;

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;


interface MessageInterface
{
    public function all(): Collection;
    public function find(int $id): Message;
    public function create(array $data): Message;
    public function update(array $data, int $id): Message;
    public function delete(int $id): Message;

}
