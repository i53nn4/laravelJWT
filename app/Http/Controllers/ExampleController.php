<?php

namespace App\Http\Controllers;

use App\Http\Services\ExampleService;
use App\Http\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;

class ExampleController extends BaseController
{
    /**
     * The response trait
     */
    use ResponseTrait;

    /**
     * The request instance.
     *
     * @var Request
     */
    private $request;

    /**
     * @var ExampleService
     */
    protected $service;

    /**
     * @param Request $request
     * @param ExampleService $service
     */
    public function __construct(Request $request, ExampleService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return $this->successResponse($this->service->index());
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => [$exception->getMessage()]]);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            return $this->successResponse($this->service->show($id));
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => [$exception->getMessage()]]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        try {
            $validator = Validator::make($this->request->all(), [
                'description' => 'required|min:4',
                'label' => 'required|min:4',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->toArray(), 422);
            }

            return $this->successResponse($this->service->store($this->request->all()), 201);
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => [$exception->getMessage()]]);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function update(int $id): JsonResponse
    {
        try {
            $validator = Validator::make($this->request->all(), [
                'description' => 'required|min:4',
                'label' => 'required|min:4',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->toArray(), 422);
            }

            return $this->successResponse($this->service->update($id, $this->request->all()), 200);
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => [$exception->getMessage()]]);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->destroy($id);

            return $this->successResponse(['message' => 'Deleted Successfully'], 200);
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => [$exception->getMessage()]]);
        }
    }
}
