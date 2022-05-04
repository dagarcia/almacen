<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 * @ORM\Table(name="productos", uniqueConstraints={@ORM\UniqueConstraint(name="idx_productos_sku", columns={"sku"})})
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="categoria", type="string")
 * @ORM\DiscriminatorMap({
 *      "laptop" = "Laptop",
 *      "televisor" = "Televisor",
 *      "zapatos" = "Zapatos"
 * })
 */
abstract class Producto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=150)
     */
    private $nombre;

    /**
     * @ORM\Column(name="sku", type="string", length=20)
     */
    private $sku;

    /**
     * @ORM\Column(name="marca", type="string", length=30)
     */
    private $marca;

    /**
     * @ORM\Column(name="costo", type="decimal", precision=10, scale=2)
     */
    private $costo;

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

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getCosto(): ?string
    {
        return $this->costo;
    }

    public function setCosto(string $costo): self
    {
        $this->costo = $costo;

        return $this;
    }
}
