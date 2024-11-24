<?php

namespace App\Http\Controllers;

use App\Services\MessageTemplateService;
use Illuminate\Http\Request;

class MessageTemplateController extends Controller
{
    public function __construct(private readonly MessageTemplateService $templateService)
    {
    }

    public function index()
    {
        return $this->templateService->all();
    }

    public function show(string $id)
    {
        return $this->templateService->find($id);
    }

    public function store(Request $request)
    {
        return $this->templateService->create($request->all());
    }

    public function update(Request $request, int $id)
    {
        return $this->templateService->update($request->all(), $id);
    }

    public function destroy(int $id)
    {
        return $this->templateService->delete($id);
    }

}
