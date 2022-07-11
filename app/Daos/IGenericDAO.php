<?php
namespace App\Daos;

interface IGenericDAO
{

    public function getAll();

    public function get(int $id);

    public function save($object);

    public function updateOrCreate($checkers, $object);

    public function destroy($ids);

}

