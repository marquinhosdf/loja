<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;


class PerfilController extends AbstractCrudController
{
    protected $entity     = 'Admin\Entity\Perfil';
    protected $filter     = 'admin-filter-perfil';
    protected $form       = 'admin-form-perfil';
    protected $service    = 'admin-service-perfil';

    protected $controller = 'perfil';
    protected $template   = 'admin/perfil/form.phtml';
    protected $order      = array('s.nome' => 'DESC');  

     public function indexAction() {
        //instanciando os services
        $this->getServiceLocator()->get('jv_flashmessenger');

        $serviceAuth = 1;

        //definir variaveis 
        $filtro = $this->params()->fromQuery();
        
        $filtro['perfil'] = isset($filtro['perfil']) ? $filtro['perfil'] : "";
        //$filtro['status'] = isset($filtro['status']) ? $filtro['status'] : "";
        
        $this->setFiltro($filtro);

        $page = isset($filtro['pagina']) ? $filtro['pagina'] : 1;
        $where = $this->getWhere(array('pagina'));

        $list = $this->getEm($this->entity)->findFilter($where, $this->order);
        $perfilParent = $this->getEm($this->entity)->findFilter(array('perfil' => "IS NULL"));
        
        
        $paginator = $this->paginator($list, $page);

        return new ViewModel(array(
            'data' => $paginator,
            'pagina' => $page,
            'filtro' => $filtro,
            'controller' => $this->controller,
            'perfil' => $perfilParent
        ));
    }
    
    
}
