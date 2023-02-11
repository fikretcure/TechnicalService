<?php

namespace App\Http\Controllers;

use App\Http\Repositories\DeviceRepository;
use App\Http\Requests\DeviceStoreRequest;
use App\Http\Requests\DeviceUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;


/**
 *
 * @property DeviceRepository $base_repository
 */
class DeviceController extends Controller
{

    /**
     *
     */
    public function __construct()
    {
        $this->base_repository = new DeviceRepository();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success($this->base_repository->index())->send();
    }

    /**
     * @param DeviceStoreRequest $request
     * @return JsonResponse
     */
    public function store(DeviceStoreRequest $request): JsonResponse
    {
        return $this->success($this->base_repository->store($request->validated()))->send();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->success($this->base_repository->show($id))->send();
    }

    /**
     * @param DeviceUpdateRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(DeviceUpdateRequest $request, $id): JsonResponse
    {
        return $this->success($this->base_repository->update($request->validated(), $id))->send();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->success($this->base_repository->destroy($id))->send();
    }
}
