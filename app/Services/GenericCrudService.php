<?php
namespace App\Services;

class GenericCrudService
{

    protected $dao;

    public function getAll($page = false)
    {
        return $this->dao->getAll($page);
    }

    public function get($id)
    {
        return $this->dao->get($id);
    }

    public function save($object)
    {
        $this->dao->save($object);
        return $object;
    }

    public function destroy($ids)
    {
        return $this->dao->destroy($ids);
    }
}
