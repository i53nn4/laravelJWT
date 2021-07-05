<?php

namespace App\Http\Repositories;

interface RepositoryInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function store(array $params);

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function update(int $id, array $params);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);
}
