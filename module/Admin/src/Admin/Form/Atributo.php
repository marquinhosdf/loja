<?php


namespace Admin\Form;

use Zend\Form\Element\Text;
use Zend\Form\Element\Select;
use Zend\Form\Form;

class Atributo extends Form{
    
    public function __construct() 
    {
        
        parent::__construct('form-resource');

        $nome = new Text('nome');
        $nome->setLabel('Nome')
                ->setAttributes(array(
                    'id' => 'nome',
                    'class' => 'form-control'
                ));
        $this->add($nome);
        
        $tipoSelecao = new Select('tipo_selecao');
        $tipoSelecao->setLabel('Tipo de seleção')
                ->setattributes(array(
                    'id' => 'tipo_selecao',
                    'class' => 'form-control',
                    'options' => array(
                       ''  => 'Selecione...', 
                       '1' => 'Radio', 
                       '2' => 'Checkbox', 
                       '3' => 'Select', 
                    ),
                ));
        $this->add($tipoSelecao);

    }
    
}
