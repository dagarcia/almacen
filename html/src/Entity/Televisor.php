<?php

namespace App\Entity;

use App\Repository\TelevisorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TelevisorRepository::class)
 * @ORM\Table(name="televisores")
 */
class Televisor extends Producto
{
    /**
     * @ORM\Column(name="tipo_pantalla", type="string", length=10)
     */
    private $tipoPantalla;

    /**
     * @ORM\Column(name="tamanio_pantalla", type="string", length=20)
     */
    private $tamanioPantalla;

    public function getTipoPantalla(): ?string
    {
        return $this->tipoPantalla;
    }

    public function setTipoPantalla(string $tipoPantalla): self
    {
        $this->tipoPantalla = $tipoPantalla;

        return $this;
    }

    public function getTamanioPantalla(): ?string
    {
        return $this->tamanioPantalla;
    }

    public function setTamanioPantalla(string $tamanioPantalla): self
    {
        $this->tamanioPantalla = $tamanioPantalla;

        return $this;
    }
}
