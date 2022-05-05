<?php

namespace App\Controller;

use App\Entity\Laptop;
use App\Entity\Televisor;
use App\Entity\Zapatos;
use App\Repository\ProductoRepository;
use App\Validators\ProductValidator;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/productos")
 */
class ProductosController extends AbstractController
{

    private $productoRepository;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ProductoRepository $productoRepository)
    {
        $this->entityManager = $entityManager;
        $this->productoRepository = $productoRepository;

    }   

    /**
     * @Route("/", name="get_productos", methods={"GET"})
     * 
     * @return JsonResponse
     */
    public function getAll() 
    {
        try {
            $productos = $this->productoRepository->findAll();
            $status = (!$productos) ? Response::HTTP_NOT_FOUND : Response::HTTP_OK;                
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $productos = null;
        }
        
        $response = [
            "success" => (isset($error)) ? false : true,
            "error" => (isset($error)) ? $error : null,
            "data" => $productos
        ];

        return $this->json($response, $status);
    }

    /**
     * @Route("/{id}", name="get_producto_by_id", methods={"GET"})
     */
    public function getOne($id)
    {
        try {
            $producto = $this->productoRepository->find($id);
            $status = (!$producto) ? Response::HTTP_NOT_FOUND : Response::HTTP_OK;                
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $producto = null;
        }
        
        $response = [
            "success" => (isset($error)) ? false : true,
            "error" => (isset($error)) ? $error : null,
            "data" => $producto
        ];

        return $this->json($response, $status);
    }

    /**
     * @Route("/", name="create_producto", methods={"POST"})
     */
    public function create(Request $request, LoggerInterface $logger)
    {
        $data = json_decode($request->getContent());

        try {
            $valid = ProductValidator::validateProductData($data);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            $status = Response::HTTP_BAD_REQUEST;
            $producto = null;
            $valid = false;
        }
        
        if ($valid) {
            switch (strtolower($data->categoria)) {
                case ProductValidator::VALID_CATEGORIES[0]:
                    $producto = new Televisor();
                    $producto->setTamanioPantalla($data->tamanio_pantalla);
                    $producto->setTipoPantalla($data->tipo_pantalla);
                break;
                case ProductValidator::VALID_CATEGORIES[1]:
                    $producto = new Laptop();
                    $producto->setProcesador($data->procesador);
                    $producto->setMemoriaRam($data->memoria_ram);
                break;
                case ProductValidator::VALID_CATEGORIES[2]:
                    $producto = new Zapatos();
                    $producto->setMaterial($data->material);
                    $producto->setTalle($data->talle);
                break;
            }

            try {
                $producto->setNombre($data->nombre);
                $producto->setSku($data->sku);
                $producto->setMarca($data->marca);
                $producto->setCosto($data->costo);
                $this->entityManager->persist($producto);
                $this->entityManager->flush();
                $status = Response::HTTP_CREATED;
            } catch (\Throwable $th) {
                $error = $th->getMessage() . "2";
                if (stripos($error, 'idx_productos_sku')) {
                    $error = "El SKU que intenta ingresar ya existe para otro producto";
                    $status = Response::HTTP_BAD_REQUEST;
                } else {
                    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
                }
                $producto = null;
            }
        }

        $response = [
            "success" => (isset($error)) ? false : true,
            "error" => (isset($error)) ? $error : null,
            "data" => $producto
        ];

        return $this->json($response, $status);

    }

}