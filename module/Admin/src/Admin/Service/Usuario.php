<?php

namespace Admin\Service;

class Usuario extends AbstractService {

    protected $entity = 'Admin\Entity\Usuario';

    public function insert(array $data, $entity = null)
    {
               
        //verificando a categoria
       $data['perfil'] = $this->getEmRef('Admin\Entity\Perfil',  $data['perfil']);
               
        parent::insert($data);
    }
    
     public function update(array $data, $id, $entity = null)
    {         
        
       $data['perfil'] = $this->getEmRef('Admin\Entity\Perfil',  $data['perfil']);
      
        parent::update($data, $id);
    }

    
}
