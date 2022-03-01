<?php

namespace App\Repositories;

interface RepositoryInterface
{

    public function getAll();

    public function getPagi($count);

    public function get();

    public function find($id);

    public function create($attributes = []);

    public function update($id, $attributes = []);

    public function delete($id);

    public function deleteWhere($where);

    public function updateWhere($where, $attributes = []);
}
