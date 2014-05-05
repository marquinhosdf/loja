<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractCrudController
 *
 * @author marcos
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\Session\Container;
use Zend\Validator\AbstractValidator;
use Zend\View\Model\ViewModel;


abstract class AbstractCrudController extends AbstractActionController {

    //put your code here

    protected $em;
    protected $service;
    protected $entity;
    protected $form;
    protected $filter;
    protected $template;
    protected $where = array();
    protected $filtro = array();
    protected $order = array();
    protected $route = 'admin/default';
    protected $module;
    protected $controller;
    protected $action;

    public function indexAction() {
        //instanciando os services
        $this->getServiceLocator()->get('jv_flashmessenger');

        $serviceAuth = 1;

        //definir variaveis 
        $filtro = $this->params()->fromQuery();
        $this->setFiltro($filtro);

        $page = isset($filtro['pagina']) ? $filtro['pagina'] : 1;
        $where = $this->getWhere(array('pagina'));

        $list = $this->getEm($this->entity)->findFilter($where, $this->order);

        $paginator = $this->paginator($list, $page);

        return new ViewModel(array(
            'data' => $paginator,
            'pagina' => $page,
            'filtro' => $filtro,
            'controller' => $this->controller
        ));
    }

    public function cadastrarAction() {

        //recuperando os parametros da url
        $request = $this->getRequest();

        //instaciar o form
        $form = $this->getServiceLocator()->get($this->form);

        //tratando os dados do filtro do container
        //criar sessao com os filtros setados no cadastro com a alteração da pagina anterior
        $container = new Container(str_replace("-", "", $this->controller));

        $url = "";
        $url .= isset($container->filtro['params']['pagina']) ? "pagina = " . $container->filtro['params']['pagina'] : 1;

        if ($request->isPost()) {
            if ($this->filter != null) {
                $form->setInputFilter($this->getServiceLocator()->get($this->filter));
            }

            AbstractValidator::setDefaultTranslator($this->getServiceLocator()->get('MvcTranslator'));
            $data = $request->getPost()->toArray();
            $form->setData($data);

            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                if ($service->insert($data)) {
                    $this->flashMessenger()->addMessage(array('success' => 'Cadastro efetuado com sucesso.'));
                } else {
                    $this->flashMessenger()->addMessage(array('error' => 'Erro no cadastro.'));
                }
                if ($this->module === null)
                    return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
                else
                    return $this->redirect()->toUrl("/" . $this->module . "/" . $this->controller . $url);
            }
        }
        $view = new ViewModel(array(
            'form' => $form,
            'controller' => $this->controller
        ));

        $view->setTemplate($this->template);

        return $view;
    }

    public function editarAction() {

        //recuperando os parametros da url
        $request = $this->getRequest();
        $id = $this->params('id');

        //instaciar o form
        $form = $this->getServiceLocator()->get($this->form);

        //tratando os dados do filtro do container
        //criar sessao com os filtros setados no cadastro com a alteração da pagina anterior
        $container = new Container(str_replace("-", "", $this->controller));

        $url = "?";
        $url .= isset($container->filtro['params']['pagina']) ? "pagina = " . $container->filtro['params']['pagina'] : 1;

        //get array contendo os dados editados
        $dataEntity = $this->getEm($this->entity)->findToArray($id);
        $form->setData($dataEntity);

        if ($request->isPost()) {
            if ($this->filter != null) {
                $form->setInputFilter($this->getServiceLocator()->get($this->filter));
            }

            AbstractValidator::setDefaultTranslator($this->getServiceLocator()->get('MvcTranslator'));

            $data = $request->getPost()->toArray();
            $form->setData($data);
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                if ($service->update($data, $id)) {
                    $this->flashMessenger()->addMessage(array('success' => 'Cadastro editado com sucesso.'));
                } else {
                    $this->flashMessenger()->addMessage(array('error' => 'Erro no editar.'));
                }
                if ($this->module === null)
                    return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
                else
                    return $this->redirect()->toUrl("/" . $this->module . "/" . $this->controller . $url);
            }
        }
        $view = new ViewModel(array(
            'form' => $form,
            'controller' => $this->controller
        ));

        $view->setTemplate($this->template);

        return $view;
    }

    public function deleteAction() {

        $id = (int) $this->params('id');    
        $service = $this->getServiceLocator()->get($this->service);

        if ($service->delete($id)) 
        {
            $this->flashMessenger()->addMessage(array('success' => 'Registro excluido com sucesso.'));
        }
        else
        {
            $this->flashMessenger()->addMessage(array('error' => 'Error ao excluir.'));            
        }        
          if($this->module === null)
                    return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
                else
                    return $this->redirect()->toUrl ("/".$this->module."/".$this->controller . $url);
           
    }

    public function getEm($entity = null) {
        if ($this->em === null) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        if ($entity !== null) {
            return $this->em->getRepository($entity);
        }

        return $this->em;
    }

    public function paginator($list, $page, $itensPorPagina = 10) {

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage($itensPorPagina);

        return $paginator;
    }

    public function getFiltro() {
        return $this->filtro;
    }

    public function setFiltro(array $filtro) {
        //verificar se o filtro foi passado 
        if (count($filtro)) {
            $this->filtro['params'] = $filtro;
        }

        //criar sessao com os filtros setados no cadastro com a alteração da pagina anterior
        $container = new Container(str_replace("-", "", $this->controller));
        $container->filtro = $this->filtro;
    }

    public function getWhere(array $exceptionsFiltro) {

        $where = $this->where;
        $filtro = $this->filtro;

        if (isset($filtro['params']) && count($filtro['params'])) {
            foreach ($filtro['params'] as $idFiltro => $valorFiltro) {
                if ((!empty($valorFiltro) || $valorFiltro == '0') && !in_array($idFiltro, $exceptionsFiltro)) {
                    $where[$idFiltro] = $valorFiltro;
                }
            }
        }

        return $where;
    }

    public function setWhere(array $where) {

        if (count($where)) {
            foreach ($where as $indice => $valor) {
                $this->where[$indice] = $valor;
            }
        }
    }

    public function getIdUsuario() {
        return 1;
    }

}
