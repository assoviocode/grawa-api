<?php

namespace App\Daos\Eloquent;

use App\Daos\IGenericDAO;

class GenericDAO implements IGenericDAO
{

    protected $classModel;

    public function getAll($paginate = false, $orderByAttribute = "", $orderByType = "ASC")
    {
        if ($paginate) {
            if (!empty($orderByAttribute)) {
                return $this->classModel::orderBy($orderByAttribute, $orderByType)->paginate(30);
            }
            return $this->classModel::paginate(30);
        }

        if (!empty($orderByAttribute)) {
            return $this->classModel::orderBy($orderByAttribute, $orderByType)->get();
        }

        return $this->classModel::all();
    }

    public function get(int $id)
    {
        return $this->classModel::firstWhere('id', $id);
    }

    public function save($object)
    {
        return $object->push();
    }

    public function updateOrCreate($checkers, $object)
    {
        return $object->updateOrCreate($checkers, $object->toArray());
    }

    public function destroy($ids)
    {
        return $this->classModel::destroy($ids);
    }
}
