<?php

namespace Admin\Filter;

use Zend\InputFilter\InputFilter;
class Categoria extends InputFilter 
{

    public function __construct()
    {
            $this->add(array(
                'name' => 'categoria',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags')
                )
            ));
            $this->add(array(
                'name' => 'nome',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags')
                )
            ));
            $this->add(array(
                'name' => 'status',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags')
                )
            ));
    }
//put your code here
}
