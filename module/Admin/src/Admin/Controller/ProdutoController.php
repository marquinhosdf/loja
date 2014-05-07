<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Validator\AbstractValidator;


class ProdutoController extends AbstractCrudController
{
    protected $entity     = 'Admin\Entity\Produto';
    protected $filter     = 'admin-filter-produto';
    protected $form       = 'admin-form-produto';
    protected $service    = 'admin-service-produto';

    protected $controller = 'produto';
    protected $template   = 'admin/produto/form.phtml';
    protected $order      = array('s.nome' => 'DESC');  

     public function indexAction() {
        //instanciando os services
        $this->getServiceLocator()->get('jv_flashmessenger');

        $serviceAuth = 1;

        //definir variaveis 
        $filtro = $this->params()->fromQuery();
        
        $filtro['categoria'] = isset($filtro['categoria']) ? $filtro['categoria'] : "";
        $filtro['ativo'] = isset($filtro['ativo']) ? $filtro['ativo'] : "";
        
        $this->setFiltro($filtro);

        $page = isset($filtro['pagina']) ? $filtro['pagina'] : 1;
        $where = $this->getWhere(array('pagina'));

        $list = $this->getEm($this->entity)->findFilter($where, $this->order);
        $categorias = $this->getEm('Admin\Entity\Categoria')->findFilter(array('categoria' => "IS NULL"));
       
        
        $paginator = $this->paginator($list, $page);

        return new ViewModel(array(
            'data' => $paginator,
            'pagina' => $page,
            'filtro' => $filtro,
            'controller' => $this->controller,
            'categorias' => $categorias
        ));
    }
    
   
    
}
