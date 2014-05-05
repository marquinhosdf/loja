<?php

namespace Admin\Repository;

use Admin\Repository\AbstractRepository;

class Perfil extends AbstractRepository{
    
    public function findToArray($id) 
    {
        $result = $this->find($id)->toArray();
        if(isset($result['perfil'])){
             $result['perfil'] = $result['perfil']->getId();
        }
        unset($result['children']);
        
        return $result;
    }
}