<?php

namespace App\Entity;

use App\Repository\ZapatosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZapatosRepository::class)
 * @ORM\Table(name="zapatos")
 */
class Zapatos extends Producto
{
    /**
     * @ORM\Column(name="material", type="string", length=10)
     */
    private $material;

    /**
     * @ORM\Column(name="talle", type="string", length=5)
     */
    private $talle;

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(string $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getTalle(): ?string
    {
        return $this->talle;
    }

    public function setTalle(string $talle): self
    {
        $this->talle = $talle;

        return $this;
    }
}
