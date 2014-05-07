<?php

namespace Admin\Repository;

use Admin\Repository\AbstractRepository;

class Produto extends AbstractRepository{
    
    public function findToArray($id) 
    {
        $result = $this->find($id)->toArray();
        $result['categoria'] = $result['categoria']->getId();
            
        return $result;
        
     
    }
    
    
}