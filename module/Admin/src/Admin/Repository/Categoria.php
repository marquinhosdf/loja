<?php

namespace Admin\Repository;

use Admin\Repository\AbstractRepository;

class Categoria extends AbstractRepository{
    
    public function findToArray($id) 
    {
        $result = $this->find($id)->toArray();
        $result['categoria'] = $result['categoria']->getId();
        unset($result['children']);
        
        return $result;
        
     
    }
    
    
}