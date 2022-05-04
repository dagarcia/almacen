<?php

namespace App\Entity;

use App\Repository\LaptopRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LaptopRepository::class)
 * @ORM\Table(name="laptops")
 */
class Laptop extends Producto
{
    /**
     * @ORM\Column(name="procesador", type="string", length=10)
     */
    private $procesador;

    /**
     * @ORM\Column(name="memoria_ram", type="string", length=10)
     */
    private $memoriaRam;

    public function getProcesador(): ?string
    {
        return $this->procesador;
    }

    public function setProcesador(string $procesador): self
    {
        $this->procesador = $procesador;

        return $this;
    }

    public function getMemoriaRam(): ?string
    {
        return $this->memoriaRam;
    }

    public function setMemoriaRam(string $memoriaRam): self
    {
        $this->memoriaRam = $memoriaRam;

        return $this;
    }
}
