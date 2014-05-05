<?php

namespace Admin\Repository;

use Admin\Repository\AbstractRepository;

class Usuario extends AbstractRepository{
    
    public function findToArray($id) 
    {
        $result = $this->find($id)->toArray();
        $result['perfil'] = $result['perfil']->getId();
            
        return $result;
        
     
    }
    
    
}