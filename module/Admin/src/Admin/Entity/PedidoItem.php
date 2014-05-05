<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PedidoItem
 *
 * @ORM\Table(name="pedido_item", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_pedido_item_pedido1_idx", columns={"pedido_id"}), @ORM\Index(name="fk_pedido_item_produto1_idx", columns={"produto_id"}), @ORM\Index(name="fk_pedido_item_pedido_item_status1_idx", columns={"pedido_item_status_id"})})
 * @ORM\Entity
 */
class PedidoItem
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
     * @ORM\Column(name="vlr_produto", type="float", precision=9, scale=2, nullable=false)
     */
    private $vlrProduto;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd", type="integer", nullable=false)
     */
    private $qtd;

    /**
     * @var float
     *
     * @ORM\Column(name="vlr_total", type="float", precision=9, scale=2, nullable=false)
     */
    private $vlrTotal;

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
     * @var \Pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_id", referencedColumnName="id")
     * })
     */
    private $pedido;

    /**
     * @var \Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     * })
     */
    private $produto;

    /**
     * @var \PedidoItemStatus
     *
     * @ORM\ManyToOne(targetEntity="PedidoItemStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_item_status_id", referencedColumnName="id")
     * })
     */
    private $pedidoItemStatus;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AtributoOpcao", inversedBy="pedidoItem")
     * @ORM\JoinTable(name="pedido_item_atributo_opcao",
     *   joinColumns={
     *     @ORM\JoinColumn(name="pedido_item_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="atributo_opcao_id", referencedColumnName="id")
     *   }
     * )
     */
    private $atributoOpcao;

    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        $this->atributoOpcao = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getVlrProduto() {
        return $this->vlrProduto;
    }

    public function getQtd() {
        return $this->qtd;
    }

    public function getVlrTotal() {
        return $this->vlrTotal;
    }

    public function getDtaInc() {
        return $this->dtaInc;
    }

    public function getDtaUpd() {
        return $this->dtaUpd;
    }

    public function getPedido() {
        return $this->pedido;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function getPedidoItemStatus() {
        return $this->pedidoItemStatus;
    }

    public function getAtributoOpcao() {
        return $this->atributoOpcao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setVlrProduto($vlrProduto) {
        $this->vlrProduto = $vlrProduto;
    }

    public function setQtd($qtd) {
        $this->qtd = $qtd;
    }

    public function setVlrTotal($vlrTotal) {
        $this->vlrTotal = $vlrTotal;
    }

    public function setDtaInc(\DateTime $dtaInc) {
        $this->dtaInc = $dtaInc;
    }

    public function setDtaUpd(\DateTime $dtaUpd) {
        $this->dtaUpd = $dtaUpd;
    }

    public function setPedido(\Pedido $pedido) {
        $this->pedido = $pedido;
    }

    public function setProduto(\Produto $produto) {
        $this->produto = $produto;
    }

    public function setPedidoItemStatus(\PedidoItemStatus $pedidoItemStatus) {
        $this->pedidoItemStatus = $pedidoItemStatus;
    }

    public function setAtributoOpcao(\Doctrine\Common\Collections\Collection $atributoOpcao) {
        $this->atributoOpcao = $atributoOpcao;
    }


}
