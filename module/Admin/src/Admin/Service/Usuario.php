<?php

namespace Admin\Service;

class Usuario extends AbstractService {

    protected $entity = 'Admin\Entity\Usuario';

    public function insert(array $data, $entity = null)
    {
               
        //verificando a categoria
       $data['perfil'] = $this->getEmRef('Admin\Entity\Perfil',  $data['perfil']);
       $data['dta_inc'] = true;   
       $data['token'] = $this->getToken();   
       
        parent::insert($data);
    }
    
     public function update(array $data, $id, $entity = null)
    {   
         
       if(empty($data['senha'])){
          unset($data['senha']);
       }else{
          $data['token'] = $this->getToken();   
       }
       
       $data['perfil'] = $this->getEmRef('Admin\Entity\Perfil',  $data['perfil']);
      
        parent::update($data, $id);
    }

    
}
