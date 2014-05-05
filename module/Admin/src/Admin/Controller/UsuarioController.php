<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;


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
    
    
}
