<?php

namespace App\Http\Controllers;

use App\Services\MessageContactService;
use Illuminate\Http\Request;

class MessageContactController extends Controller
{
    public function __construct(private readonly MessageContactService $contactService)
    {
    }

    public function index()
    {
        return $this->contactService->all();
    }

    public function show(string $id)
    {
        return $this->contactService->find($id);
    }

    public function store(Request $request)
    {
        return $this->contactService->create($request->all());
    }

    public function update(Request $request, int $id)
    {
        return $this->contactService->update($request->all(), $id);
    }

    public function destroy(int $id)
    {
        return $this->contactService->delete($id);
    }

}
