<?php


namespace Admin\Form;

use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;

class Perfil extends Form{
    
    public function __construct(ServiceLocatorInterface $sl) 
    {
        
        parent::__construct('form-perfil');
        
        $em = $sl->get('Doctrine\ORM\EntityManager');    
        
        $arrPerfil = array('0' => 'Perfil Principal'); 
        
        $repoPerfil = $em->getRepository('Admin\Entity\Perfil');
        
        $arrPerfil += $repoPerfil->findPairs();
            
        $parent = new Select('perfil');
        $parent->setLabel('Perfil Parentesco')
                ->setAttributes(array(
                    'id' => 'perfil',
                    'class' => 'form-control',
                    'options' => $arrPerfil
                ));
        $this->add($parent);  
        
        $nome = new Text('nome');
        $nome->setLabel('Nome')
                ->setAttributes(array(
                    'id' => 'nome',
                    'class' => 'form-control'
                ));
        $this->add($nome);

    }
    
}
