<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractController
 *
 * @author marcos
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;

abstract class AbstractController extends AbstractActionController {

    protected $em;

    public function getEm($entity = null) {
        if ($this->em === null) {
            $this->em = $this - getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        if ($entity !== null) {
            return $this->em->getRepository($entity);
        }

        return $this->em;
    }

    public function paginator($list, $page, $itensPorPagina = 10){
        
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage($itensPorPagina);
        
        return $paginator;
    }
    
}
