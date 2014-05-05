<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * AtributoOpcao
 *
 * @ORM\Table(name="atributo_opcao", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_atributo_opcao_atributo1_idx", columns={"atributo_id"})})
 * @ORM\Entity
 */
class AtributoOpcao
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
     * @ORM\Column(name="codigo", type="string", length=45, nullable=true)
     */
    private $codigo;

    /**
     * @var \Atributo
     *
     * @ORM\ManyToOne(targetEntity="Atributo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="atributo_id", referencedColumnName="id")
     * })
     */
    private $atributo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="PedidoItem", mappedBy="atributoOpcao")
     */
    private $pedidoItem;

    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        $this->pedidoItem = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getNome() {
        return $this->nome;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getAtributo() {
        return $this->atributo;
    }

    public function getPedidoItem() {
        return $this->pedidoItem;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setAtributo(\Atributo $atributo) {
        $this->atributo = $atributo;
    }

    public function setPedidoItem(\Doctrine\Common\Collections\Collection $pedidoItem) {
        $this->pedidoItem = $pedidoItem;
    }


}
