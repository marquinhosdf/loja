<?php

namespace Admin\Service;

class Produto extends AbstractService {

    protected $entity = 'Admin\Entity\Produto';

    public function insert(array $data, $entity = null)
    {
               
       $data['slug'] = $this->tituloToSlug($data['nome']);  
       $data['usuario'] = $this->getEmRef('Admin\Entity\Usuario',  $this->getIdUsuario());
       $data['categoria'] = $this->getEmRef('Admin\Entity\Categoria',  $data['categoria']);
       $data['dta_inc'] = true;   
       $data['dta_upd'] = true;   
       
        parent::insert($data);
    }
    
     public function update(array $data, $id, $entity = null)
    {   
         
       $data['slug'] = $this->tituloToSlug($data['nome']);  
       $data['categoria'] = $this->getEmRef('Admin\Entity\Categoria',  $data['categoria']);
       $data['dta_upd'] = true; 
       
        parent::update($data, $id);
    }

    
}
