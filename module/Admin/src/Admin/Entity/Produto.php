<?php

namespace Admin\Entity;


use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Produto
 *
 * @ORM\Table(name="produto", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_produto_usuario1_idx", columns={"usuario_id"}), @ORM\Index(name="fk_produto_categoria1_idx", columns={"categoria_id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Produto")
 */
class Produto
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
     * @ORM\Column(name="nome", type="string", length=200, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=200, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=false)
     */
    private $descricao;

    /**
     * @var float
     *
     * @ORM\Column(name="preco", type="float", precision=9, scale=2, nullable=false)
     */
    private $preco;

    /**
     * @var float
     *
     * @ORM\Column(name="peso", type="float", precision=9, scale=2, nullable=false)
     */
    private $peso;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ativo", type="boolean", nullable=false)
     */
    private $ativo;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="dta_inc", type="datetime", nullable=false)
     */
    private $dtaInc;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="dta_upd", type="datetime", nullable=false)
     */
    private $dtaUpd;

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
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Atributo", inversedBy="produto")
     * @ORM\JoinTable(name="produto_atributo",
     *   joinColumns={
     *     @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="atributo_id", referencedColumnName="id")
     *   }
     * )
     */
    private $atributo;

    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        $this->atributo = new ArrayCollection();
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);
    }

    public function toArray() {
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

    public function getDescricao() {
        return $this->descricao;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getDtaInc() {
        return $this->dtaInc;
    }

    public function getDtaUpd() {
        return $this->dtaUpd;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getAtributo() {
        return $this->atributo;
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

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function setDtaInc() {
        $this->dtaInc = new DateTime('now');
    }

    public function setDtaUpd() {
        $this->dtaUpd = new DateTime('now');
    }

    public function setUsuario(Usuario $usuario) {
        $this->usuario = $usuario;
    }

    public function setCategoria(Categoria $categoria) {
        $this->categoria = $categoria;
    }

    public function setAtributo(Collection $atributo) {
        $this->atributo = $atributo;
    }


    
}
