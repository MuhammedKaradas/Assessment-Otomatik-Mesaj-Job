<?php

namespace App\Http\Controllers;

use App\Services\MessageTemplateService;
use Illuminate\Http\Request;

class MessageTemplateController extends Controller
{
    public function __construct(private readonly MessageTemplateService $templateService) {}

    /**
     * @OA\Get(
     *     path="/api/templates",
     *     tags={"Templates"},
     *     summary="Mesaj Şablon Listesi",
     *     security={
     *           {"X-Api-Key": {}}
     *       },
     *     @OA\Response(
     *         response="200",
     *         description="Mesaj Şablon Listesi.",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function index()
    {
        return $this->templateService->all();
    }

    /**
     * @OA\Get(
     *    path="/api/templates/{id}",
     *    operationId="MessageTemplateController_show",
     *    tags={"Templates"},
     *    summary="Mesaj Şablon",
     *    description="Mesaj Şablon Bilgilerini getirir.",
     *   security={
     *          {"X-Api-Key": {}}
     *      },
     *    @OA\Parameter(
     *            name="id",
     *            in="path",
     *            description="Id li Mesaj Şablon",
     *            required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(
     *                property="status_code",
     *                type="integer",
     *                 example="200"
     *              ),
     *          @OA\Property(
     *               property="data",
     *               type="object"
     *              )
     *           ),
     *        )
     *       )
     *  )
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id)
    {
        return $this->templateService->find($id);
    }

    /**
     * @OA\PathItem(
     *     path="/api/messages",
     *     summary="Mesajlar ile ilgili işlemler",
     *     description="Bu uç noktalar mesajlarla ilgili işlemleri içerir"
     * )
     */
    public function store(Request $request)
    {
        return $this->templateService->create($request->all());
    }

    /**
     * @OA\PathItem(
     *     path="/api/messages",
     *     summary="Mesajlar ile ilgili işlemler",
     *     description="Bu uç noktalar mesajlarla ilgili işlemleri içerir"
     * )
     */
    public function update(Request $request, int $id)
    {
        return $this->templateService->update($request->all(), $id);
    }

    /**
     * @OA\PathItem(
     *     path="/api/messages",
     *     summary="Mesajlar ile ilgili işlemler",
     *     description="Bu uç noktalar mesajlarla ilgili işlemleri içerir"
     * )
     */
    public function destroy(int $id)
    {
        return $this->templateService->delete($id);
    }
}
