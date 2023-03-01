<?php

namespace App\Entity;

use App\Repository\RegistroRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=RegistroRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *     fields={"correo"},
 *     errorPath="correo",
 *     message="Este correo ya está siendo utilizado"
 * )
 */
class Registro
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellido;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Gedmo\Slug(fields={"nombre", "apellido"}, updatable=false)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $genero;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $nacimiento;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $correo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $afiliacion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $area;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $newsletter;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $miembrosmm;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comentarios;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(?string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getNacimiento(): ?\DateTimeInterface
    {
        return $this->nacimiento;
    }

    public function setNacimiento(\DateTimeInterface $nacimiento = null): self
    {
        $this->nacimiento = $nacimiento;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getAfiliacion(): ?string
    {
        return $this->afiliacion;
    }

    public function setAfiliacion(string $afiliacion): self
    {
        $this->afiliacion = $afiliacion;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getNewsletter(): ?string
    {
        return $this->newsletter;
    }

    public function setNewsletter(?string $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    public function getMiembrosmm(): ?string
    {
        return $this->miembrosmm;
    }

    public function setMiembrosmm(?string $miembrosmm): self
    {
        $this->miembrosmm = $miembrosmm;

        return $this;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setCreated(new \DateTime());
        $this->setModified(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setModified(new \DateTime());
    }

    public function getComentarios(): ?string
    {
        return $this->comentarios;
    }

    public function setComentarios(?string $comentarios): self
    {
        $this->comentarios = $comentarios;

        return $this;
    }
}