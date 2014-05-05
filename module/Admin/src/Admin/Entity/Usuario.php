<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_usuario_perfil_idx", columns={"perfil_id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Usuario")
 */
class Usuario
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
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=255, nullable=false)
     */
    private $senha;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     */
    private $token;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dta_inc", type="datetime", nullable=false)
     */
    private $dtaInc;

    /**
     * @var \Perfil
     *
     * @ORM\ManyToOne(targetEntity="Perfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="perfil_id", referencedColumnName="id")
     * })
     */
    private $perfil;
    
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

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getToken() {
        return $this->token;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getDtaInc() {
        return $this->dtaInc;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setDtaInc(\DateTime $dtaInc) {
        $this->dtaInc = $dtaInc;
    }

    public function setPerfil(\Perfil $perfil) {
        $this->perfil = $perfil;
    }




}
