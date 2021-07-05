<?php

namespace App\Http\Services;

use App\Http\Repositories\ExampleRepository;

class ExampleService
{
    /**
     * @var ExampleRepository
     */
    protected $repository;

    /**
     * @param ExampleRepository $repository
     */
    public function __construct(ExampleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function index(): array
    {
        return $this->repository->index()->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function show(int $id): array
    {
        return $this->repository->show($id)->toArray();
    }

    /**
     * @param array $params
     * @return array
     */
    public function store(array $params): array
    {
        return $this->repository->store($params)->toArray();
    }

    /**
     * @param int $id
     * @param array $params
     * @return array
     */
    public function update(int $id, array $params): array
    {
        return $this->repository->update($id, $params)->toArray();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return $this->repository->destroy($id);
    }
}
