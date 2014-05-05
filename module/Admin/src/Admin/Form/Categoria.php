<?php


namespace Admin\Form;

use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;

class Categoria extends Form{
    
    public function __construct(ServiceLocatorInterface $sl) 
    {
        
        parent::__construct('form-categoria');
        
        $em = $sl->get('Doctrine\ORM\EntityManager');    
        
        $arrayCategorias = array('0' => 'Categoria Principal'); 
        
        $entityCategoria = $em->getRepository('Admin\Entity\Categoria');
        
        $arrayCategorias += $entityCategoria->findPairs();
            
        $parent = new Select('categoria');
        $parent->setLabel('Categoria Parentesco')
                ->setAttributes(array(
                    'id' => 'categoria',
                    'class' => 'form-control',
                    'options' => $arrayCategorias
                ));
        $this->add($parent);  
        
        $nome = new Text('nome');
        $nome->setLabel('Nome')
                ->setAttributes(array(
                    'id' => 'nome',
                    'class' => 'form-control'
                ));
        $this->add($nome);

        
        $status = new Select('status');
        $status->setLabel('Status')
                ->setAttributes(array(
                    'id' => 'status',
                    'class' => 'form-control',
                    'options' => array(
                        '' => 'Selecione...',
                        '1' => 'Ativo',
                        '0' => 'Inativo'
                    )
                ));
        $this->add($status);
    }
    
}
