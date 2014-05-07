<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Validator\AbstractValidator;


class UsuarioController extends AbstractCrudController
{
    protected $entity     = 'Admin\Entity\Usuario';
    protected $filter     = 'admin-filter-usuario';
    protected $form       = 'admin-form-usuario';
    protected $service    = 'admin-service-usuario';

    protected $controller = 'usuario';
    protected $template   = 'admin/usuario/form.phtml';
    protected $order      = array('s.nome' => 'DESC');  

     public function indexAction() {
        //instanciando os services
        $this->getServiceLocator()->get('jv_flashmessenger');

        $serviceAuth = 1;

        //definir variaveis 
        $filtro = $this->params()->fromQuery();
        
        $filtro['perfil'] = isset($filtro['perfil']) ? $filtro['perfil'] : "";
        $filtro['status'] = isset($filtro['status']) ? $filtro['status'] : "";
        
        $this->setFiltro($filtro);

        $page = isset($filtro['pagina']) ? $filtro['pagina'] : 1;
        $where = $this->getWhere(array('pagina'));

        $list = $this->getEm($this->entity)->findFilter($where, $this->order);
        $perfil = $this->getEm('Admin\Entity\Perfil')->findAll();
     
        
        $paginator = $this->paginator($list, $page);

        return new ViewModel(array(
            'data' => $paginator,
            'pagina' => $page,
            'filtro' => $filtro,
            'controller' => $this->controller,
            'perfil' => $perfil
        ));
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
                $filter = $this->getServiceLocator()->get($this->filter);
                $filter->get('senha')->setRequired(false);
              
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
    
}
