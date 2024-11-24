<?php

namespace App\Interfaces;

use App\Models\MessageContact;
use Illuminate\Database\Eloquent\Collection;


interface MessageContactInterface
{
    public function all(): Collection;
    public function find(int $id): MessageContact;
    public function create(array $data): MessageContact;
    public function update(array $data, int $id): MessageContact;
    public function delete(int $id): MessageContact;

}
