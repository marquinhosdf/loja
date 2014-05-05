<?php

namespace Admin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Uri extends AbstractHelper {
    
    protected $uri;
    
    public function __contruct($uri)
    {
        $this->uri = $uri;   
    }
    
    public function __invoke() 
    {
        return $this->uri;
    }
    
}