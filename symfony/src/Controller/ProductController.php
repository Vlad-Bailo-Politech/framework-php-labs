<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private const PRODUCTS = [
        ['id' => '1', 'name' => 'Apple', 'description' => 'Fruit', 'price' => 10],
        ['id' => '2', 'name' => 'Banana', 'description' => 'Fruit', 'price' => 15],
    ];

    #[Route('/products', name: 'get_products', methods: [Request::METHOD_GET])]
    public function getProducts(): JsonResponse {
        return $this->json(['data' => self::PRODUCTS], 200);
    }

    #[Route('/products/{id}', name: 'get_product_item', methods: [Request::METHOD_GET])]
    public function getProductItem(string $id): JsonResponse {
        foreach (self::PRODUCTS as $product) {
            if ($product['id'] === $id) {
                return $this->json(['data' => $product], 200);
            }
        }
        return $this->json(['data' => ['error' => 'Not found product by id ' . $id]], 404);
    }

    #[Route('/products', name: 'create_product', methods: [Request::METHOD_POST])]
    public function createProduct(Request $request): JsonResponse {
        $requestData = json_decode($request->getContent(), true);

        $newProduct = [
            'id' => rand(1000, 9999),
            'name' => $requestData['name'],
            'description' => $requestData['description'],
            'price' => $requestData['price'],
        ];

        // TODO: додати до масиву або БД
        return $this->json(['data' => $newProduct], 201);
    }
}