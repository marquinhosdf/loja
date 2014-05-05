<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_pedido_usuario1_idx", columns={"usuario_id"}), @ORM\Index(name="fk_pedido_pedido_status1_idx", columns={"pedido_status_id"}), @ORM\Index(name="fk_pedido_frete1_idx", columns={"frete_id"})})
 * @ORM\Entity
 */
class Pedido
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
     * @var float
     *
     * @ORM\Column(name="vl_total", type="float", precision=9, scale=2, nullable=false)
     */
    private $vlTotal;

    /**
     * @var float
     *
     * @ORM\Column(name="vl_pago", type="float", precision=9, scale=2, nullable=false)
     */
    private $vlPago;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dta_inc", type="datetime", nullable=false)
     */
    private $dtaInc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dta_upd", type="datetime", nullable=false)
     */
    private $dtaUpd;

    /**
     * @var float
     *
     * @ORM\Column(name="vlr_frete", type="float", precision=9, scale=2, nullable=false)
     */
    private $vlrFrete;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="text", nullable=true)
     */
    private $obs;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var \PedidoStatus
     *
     * @ORM\ManyToOne(targetEntity="PedidoStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_status_id", referencedColumnName="id")
     * })
     */
    private $pedidoStatus;

    /**
     * @var \Frete
     *
     * @ORM\ManyToOne(targetEntity="Frete")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="frete_id", referencedColumnName="id")
     * })
     */
    private $frete;

    
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

    public function getVlTotal() {
        return $this->vlTotal;
    }

    public function getVlPago() {
        return $this->vlPago;
    }

    public function getDtaInc() {
        return $this->dtaInc;
    }

    public function getDtaUpd() {
        return $this->dtaUpd;
    }

    public function getVlrFrete() {
        return $this->vlrFrete;
    }

    public function getObs() {
        return $this->obs;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getPedidoStatus() {
        return $this->pedidoStatus;
    }

    public function getFrete() {
        return $this->frete;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setVlTotal($vlTotal) {
        $this->vlTotal = $vlTotal;
    }

    public function setVlPago($vlPago) {
        $this->vlPago = $vlPago;
    }

    public function setDtaInc(\DateTime $dtaInc) {
        $this->dtaInc = $dtaInc;
    }

    public function setDtaUpd(\DateTime $dtaUpd) {
        $this->dtaUpd = $dtaUpd;
    }

    public function setVlrFrete($vlrFrete) {
        $this->vlrFrete = $vlrFrete;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }

    public function setUsuario(\Usuario $usuario) {
        $this->usuario = $usuario;
    }

    public function setPedidoStatus(\PedidoStatus $pedidoStatus) {
        $this->pedidoStatus = $pedidoStatus;
    }

    public function setFrete(\Frete $frete) {
        $this->frete = $frete;
    }



}
