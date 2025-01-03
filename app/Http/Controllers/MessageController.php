<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessageJob;
use App\Services\MessageService;
use App\Services\MessageTemplateService;
use App\Services\MessageContactService;
use Illuminate\Http\Request;


class MessageController extends Controller
{

    private MessageService $messageService;


    /**
     * @OA\PathItem(
     *     path="/api/messages",
     *     summary="Mesajlar ile ilgili işlemler",
     *     description="Bu uç noktalar mesajlarla ilgili işlemleri içerir"
     * )
     */
    public function __construct(private readonly MessageService $_messageService)
    {
        $this->messageService = $_messageService;
    }

    /**
     * @OA\Get(
     *     path="/api/messages",
     *     tags={"Messages"},
     *     summary="Mesaj Özet Listesi",
     *     security={
     *           {"X-Api-Key": {}}
     *       },
     *     @OA\Response(
     *         response="200",
     *         description="Mesaj Özet Listesi.",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function index()
    {
        return $this->messageService->all();
    }

    /**
     * @OA\Get(
     *    path="/api/messages/{id}",
     *    operationId="MessagesController_show",
     *    tags={"Messages"},
     *    summary="Mesaj Özet",
     *    description="Mesaj Özet Bilgilerini getirir.",
     *   security={
     *          {"X-Api-Key": {}}
     *      },
     *    @OA\Parameter(
     *            name="id",
     *            in="path",
     *            description="Id li Mesaj Özet",
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
        return $this->messageService->find($id);
    }

    /**
     * @OA\Post(
     *      path="/api/messages",
     *      operationId="store",
     *      tags={"Messages"},
     *      summary="Mesaj Gönder",
     *      description="Gönderilmesi istenen mesaj kaydını oluşturur.",
     *      security={
     *           {"X-Api-Key": {}}
     *       },
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"contact_id", "template_id"},
     *            @OA\Property(
     *              property="contact_id",
     *              type="integer",
     *              format="integer",
     *              example="1"
     *              ),
     *            @OA\Property(
     *              property="template_id",
     *              type="integer",
     *              format="integer",
     *              example="1"
     *              ),
     *            @OA\Property(
     *              property="status",
     *              type="integer",
     *              format="integer",
     *              example="1"
     *              ),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                property="status",
     *                type="integer",
     *                 example=""
     *                 ),
     *             @OA\Property(
     *                property="data",
     *               type="object"
     *               )
     *          )
     *       )
     *  )
     *
     * @param StoreStudentRequest $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        return $this->messageService->create($request->all());
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
        return $this->messageService->update($request->all(), $id);
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
        return $this->messageService->delete($id);
    }

    //Custom Methods

    /**
     * @OA\Get(
     *    path="/api/messages/send-messages",
     *    operationId="send-messages",
     *    tags={"Messages"},
     *    summary="Job Tetikle",
     *    description="Job ı Queue ya ekler.",
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
    public function sendMessages()
    {
        $messages = $this->messageService->allUnsent();

        if ($messages->isNotEmpty()) {
            SendMessageJob::dispatch($messages);
            return response()->json(['message' => 'Mesajlar Başarılı Şekilde Gönderildi.'], 200);
        } else {
            return response()->json(['message' => 'Queue da Herhangi Bir Mesaj Bulunmadığından Job Sonlandırıldı.'], 200);
        }
    }
}
