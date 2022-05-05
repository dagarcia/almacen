<?php

namespace App\Validators;

use stdClass;

abstract class ProductValidator
{
    public const VALID_CATEGORIES = ["televisor", "laptop", "zapatos"];
    public const VALID_PROCESSORS = ["intel", "amd"];
    public const VALID_MATERIALS = ["piel", "plástico"];
    public const VALID_DISPLAYS = ["led", "lcd", "oled"];
    public const ERROR_INVALID_FORMAT = "El formato de los datos no es válido. Se deben especificar los siguientes campos: %s";
    public const ERROR_INVALID_DATA = "Los valores válidos para el campo %s son: %s";
    public const ERROR_REQUIRED = "El/Los campo/s %s no puede/n estar vacio/s";
    public const ERROR_NOT_FLOAT = "El valor del campo %s debe ser decimal";

    private $errors=[];

    static public function validateProductData(stdClass $productData): ?bool
    {
        if (!(isset($productData->categoria) && isset($productData->nombre) && isset($productData->sku) && isset($productData->marca) && isset($productData->costo))) {
            throw new \Exception(sprintf(self::ERROR_INVALID_FORMAT, "'categoria', 'nombre', 'sku', 'marca' y 'costo'"));
        }

        if (empty($productData->categoria) || empty($productData->nombre) || empty($productData->sku) || empty($productData->marca) || empty($productData->costo)) {
            throw new \Exception(sprintf(self::ERROR_REQUIRED, "'categoria', 'nombre', 'sku', 'marca' y 'costo'"));
        }

        if (!(is_numeric($productData->costo))) {
            throw new \Exception(sprintf(self::ERROR_NOT_FLOAT, "'costo'"));
        }

        $categoria = strtolower($productData->categoria);

        if (!in_array(strtolower($categoria), self::VALID_CATEGORIES)) {
            throw new \Exception(sprintf(self::ERROR_INVALID_DATA, "'categoria'", implode("|", self::VALID_CATEGORIES)));
        }

        switch($categoria) {
            case self::VALID_CATEGORIES[0]:
                if (!(isset($productData->tipo_pantalla) && isset($productData->tamanio_pantalla))) {
                    throw new \Exception(sprintf(self::ERROR_INVALID_FORMAT, "'tipo_pantalla' y 'tamanio_pantalla'"));
                }

                $tipoPantalla = $productData->tipo_pantalla;

                if (!in_array(strtolower($tipoPantalla), self::VALID_DISPLAYS)) {
                    throw new \Exception(sprintf(self::ERROR_INVALID_DATA, "'tipo_pantalla'", implode("|", self::VALID_DISPLAYS)));
                }

                if (empty($productData->tamanio_pantalla)) {
                    throw new \Exception(sprintf(self::ERROR_REQUIRED, "'tamanio_pantalla'"));
                }

            break;

            case self::VALID_CATEGORIES[1]:
                if (!(isset($productData->procesador) && isset($productData->memoria_ram))) {
                    throw new \Exception(sprintf(self::ERROR_INVALID_FORMAT, "'procesador' y 'memoria_ram'"));
                }

                $procesador = $productData->procesador;

                if (!in_array(strtolower($procesador), self::VALID_PROCESSORS)) {
                    throw new \Exception(sprintf(self::ERROR_INVALID_DATA, "'procesador'", implode("|", self::VALID_PROCESSORS)));
                }

                if (empty($productData->tamanio_pantalla)) {
                    throw new \Exception(sprintf(self::ERROR_REQUIRED, "'memoria_ram'"));
                }

            break;

            case self::VALID_CATEGORIES[2]:
                if (!(isset($productData->material) && isset($productData->talle))) {
                    throw new \Exception(sprintf(self::ERROR_INVALID_FORMAT, "'material' y 'talle'"));
                }

                $material = $productData->material;

                if (!in_array(strtolower($material), self::VALID_MATERIALS)) {
                    throw new \Exception(sprintf(self::ERROR_INVALID_DATA, "'material'", implode("|", self::VALID_MATERIALS)));
                }

                if (empty($productData->tamanio_pantalla)) {
                    throw new \Exception(sprintf(self::ERROR_REQUIRED, "'talle'"));
                }

            break;
        }

        return true;
    }


}