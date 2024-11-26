<?php

namespace App\Http\Controllers;

use App\Services\MessageContactService;
use Illuminate\Http\Request;

class MessageContactController extends Controller
{
    public function __construct(private readonly MessageContactService $contactService) {}

    /**
     * @OA\Get(
     *     path="/api/contacts",
     *     tags={"Contacts"},
     *     summary="Mesaj Kişi Bilgileri Listesi",
     *     security={
     *           {"X-Api-Key": {}}
     *       },
     *     @OA\Response(
     *         response="200",
     *         description="Mesaj Kişi Bilgileri Listesi.",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function index()
    {
        return $this->contactService->all();
    }

    /**
     * @OA\Get(
     *    path="/api/contacts/{id}",
     *    operationId="MessageContactController_show",
     *    tags={"Contacts"},
     *    summary="Kişi Bilgileri",
     *    description="Kişi Bilgilerini getirir.",
     *   security={
     *          {"X-Api-Key": {}}
     *      },
     *    @OA\Parameter(
     *            name="id",
     *            in="path",
     *            description="Id li Kişi Bilgileri",
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
        return $this->contactService->find($id);
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
        return $this->contactService->create($request->all());
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
        return $this->contactService->update($request->all(), $id);
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
        return $this->contactService->delete($id);
    }
}
