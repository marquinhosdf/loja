<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Atributo
 *
 * @ORM\Table(name="atributo")
 * @ORM\Entity
 */
class Atributo
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
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo_selecao", type="boolean", nullable=false)
     */
    private $tipoSelecao;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produto", mappedBy="atributo")
     */
    private $produto;

    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        $this->produto = new \Doctrine\Common\Collections\ArrayCollection();
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);
    }
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipoSelecao() {
        return $this->tipoSelecao;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setTipoSelecao($tipoSelecao) {
        $this->tipoSelecao = $tipoSelecao;
    }

    public function setProduto(\Doctrine\Common\Collections\Collection $produto) {
        $this->produto = $produto;
    }


}
