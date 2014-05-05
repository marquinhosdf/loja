<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstoqueLog
 *
 * @ORM\Table(name="estoque_log", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_estoque_log_estoque1_idx", columns={"estoque_id"})})
 * @ORM\Entity
 */
class EstoqueLog
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
     * @var \DateTime
     *
     * @ORM\Column(name="dta_inc", type="datetime", nullable=false)
     */
    private $dtaInc;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd", type="integer", nullable=false)
     */
    private $qtd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo", type="boolean", nullable=false)
     */
    private $tipo;

    /**
     * @var \Estoque
     *
     * @ORM\ManyToOne(targetEntity="Estoque")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estoque_id", referencedColumnName="id")
     * })
     */
    private $estoque;

    public function __construct(array $data) {     
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);
    }
    
    
    public function toArray(){
        $hydrator = new ClassMethods();
        return $hydrator->extract($this);
    }
    
    public function getId() {
        return $this->id;
    }

    public function getDtaInc() {
        return $this->dtaInc;
    }

    public function getQtd() {
        return $this->qtd;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDtaInc(\DateTime $dtaInc) {
        $this->dtaInc = $dtaInc;
    }

    public function setQtd($qtd) {
        $this->qtd = $qtd;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setEstoque(\Estoque $estoque) {
        $this->estoque = $estoque;
    }


    

}
