<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Categoria")
 */
class Categoria
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
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=60, nullable=false)
     */
    private $slug;

    /**
     * @var Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="children")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;
    
    /**
     *
     * @var \Categoria
     * @ORM\OneToMany(targetEntity="Categoria", mappedBy="Categoria")
     */
    private $children;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

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

    public function getSlug() {
        return $this->slug;
    }


    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }


    public function setStatus($status) {
        $this->status = $status;
    }
    public function getCategoria() {
        return $this->categoria;
    }

    public function getChildren() {
        return $this->children;
    }

    public function setCategoria(Categoria $categoria) {
        $this->categoria = $categoria;
    }

    public function setChildren(Categoria $children) {
        $this->children = $children;
    }



}
