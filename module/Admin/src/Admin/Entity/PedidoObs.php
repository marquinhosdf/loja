<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PedidoObs
 *
 * @ORM\Table(name="pedido_obs", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_pedido_obs_usuario1_idx", columns={"usuario_id"}), @ORM\Index(name="fk_pedido_obs_pedido1_idx", columns={"pedido_id"})})
 * @ORM\Entity
 */
class PedidoObs
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
     * @ORM\Column(name="text", type="text", nullable=false)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dta_inc", type="datetime", nullable=false)
     */
    private $dtaInc;

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
     * @var \Pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_id", referencedColumnName="id")
     * })
     */
    private $pedido;

      public function __construct(array $data) {
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);
    }

    public function toArray() {
        $hydrator = new ClassMethods();
        return $hydrator->extract($this);
    }

    public function getId() {
        return $this->id;
    }

    public function getText() {
        return $this->text;
    }

    public function getDtaInc() {
        return $this->dtaInc;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getPedido() {
        return $this->pedido;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setDtaInc(\DateTime $dtaInc) {
        $this->dtaInc = $dtaInc;
    }

    public function setUsuario(\Usuario $usuario) {
        $this->usuario = $usuario;
    }

    public function setPedido(\Pedido $pedido) {
        $this->pedido = $pedido;
    }



}
