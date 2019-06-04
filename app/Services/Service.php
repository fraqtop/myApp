<?php


namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface Service
{
    public function create(Request $request) : Model;
    public function get(int $id) : Model;
    public function getAll(): Collection;
    public function update(int $id, array $data);
    public function delete(Request $request);
}