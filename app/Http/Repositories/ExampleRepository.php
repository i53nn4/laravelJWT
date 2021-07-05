<?php

namespace App\Http\Repositories;

use App\Models\Example;
use Illuminate\Database\Eloquent\Collection;

class ExampleRepository implements RepositoryInterface
{
    /**
     * @return Example[]|Collection
     */
    public function index()
    {
        return Example::all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return Example::find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function store(array $params)
    {
        return Example::create($params);
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function update(int $id, array $params)
    {
        $value = Example::findOrFail($id);
        $value->update($params);

        return $value;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        return Example::findOrFail($id)->delete();
    }
}
