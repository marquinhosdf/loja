<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Perfil
 *
 * @ORM\Table(name="perfil", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Perfil")
 */
class Perfil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=60, nullable=false)
     */
    private $nome;

     /**
     * @var Perfil
     *
     * @ORM\ManyToOne(targetEntity="Perfil", inversedBy="children")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="perfil_id", referencedColumnName="id")
     * })
     */
    private $perfil;
    
    /**
     *
     * @var \Perfil
     * @ORM\OneToMany(targetEntity="Perfil", mappedBy="Perfil")
     */
    private $children;


     public function __construct(array $data) {
        
        $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
        $hydrator->hydrate($data, $this);
    }
    
    
    public function toArray(){
        $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
        return $hydrator->extract($this);
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

  
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function getChildren() {
        return $this->children;
    }

    public function setPerfil(Perfil $perfil) {
        $this->perfil = $perfil;
    }

    public function setChildren(Perfil $children) {
        $this->children = $children;
    }




}
