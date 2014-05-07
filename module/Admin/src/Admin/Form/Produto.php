<?php


namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Checkbox;
use Zend\ServiceManager\ServiceLocatorInterface;

class Produto extends Form{
    
    public function __construct(ServiceLocatorInterface $sl) 
    {
        
        parent::__construct('form-produto');
        
        $em = $sl->get('Doctrine\ORM\EntityManager');    
        
        $arrCategorias = array('0' => 'Selecione...'); 
        
        $repoCategorias = $em->getRepository('Admin\Entity\Categoria');
        $arrCategorias += $repoCategorias->findPairs(array('categoria' => "IS NULL"));   
      
        $categoria = new Select('categoria');
        $categoria->setLabel('Categoria')
                ->setAttributes(array(
                    'id' => 'categoria',
                    'class' => 'form-control',
                    'options' => $arrCategorias
                ));
        $this->add($categoria);  
        
        $nome = new Text('nome');
        $nome->setLabel('Nome')
                ->setAttributes(array(
                    'id' => 'nome',
                    'class' => 'form-control'
                ));
        $this->add($nome);
        
        $slug = new Text('slug');
        $slug->setLabel('Slug')
                ->setAttributes(array(
                    'id' => 'slug',
                    'class' => 'form-control'
                ));
        $this->add($slug);
        
        $descricao = new Textarea('descricao');
        $descricao->setLabel('Descrição')
                ->setAttributes(array(
                    'id' => 'descricao',
                    'class' => 'form-control'
                ));
        $this->add($descricao);
        
        $preco = new Text('preco');
        $preco->setLabel('Preço')
                ->setAttributes(array(
                    'id' => 'preco',
                    'class' => 'form-control'
                ));
        $this->add($preco);
        
        $peso = new Text('peso');
        $peso->setLabel('Peso')
                ->setAttributes(array(
                    'id' => 'peso',
                    'class' => 'form-control'
                ));
        $this->add($peso);
        
        $ativo = new Checkbox('ativo');
        $ativo->setLabel('Ativo')
                ->setAttributes(array(
                    'id' => 'ativo',
                    'class' => 'form-control'
                ));
        $this->add($ativo);

    }
    
}
