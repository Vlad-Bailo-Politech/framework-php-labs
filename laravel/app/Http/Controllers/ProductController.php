<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private const PRODUCTS = [
        ['id' => '1', 'name' => 'Apple', 'description' => 'Fruit', 'price' => 10],
        ['id' => '2', 'name' => 'Banana', 'description' => 'Fruit', 'price' => 15],
    ];

    public function getProducts(): JsonResponse
    {
        return response()->json(['data' => self::PRODUCTS], 200);
    }

    public function getProductItem(string $id): JsonResponse
    {
        foreach (self::PRODUCTS as $product) {
            if ($product['id'] === $id) {
                return response()->json(['data' => $product], 200);
            }
        }

        return response()->json(['data' => ['error' => "Not found product by id $id"]], 404);
    }

    public function createProduct(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $newProduct = [
            'id' => rand(1000, 9999),
            'name' => $requestData['name'],
            'description' => $requestData['description'],
            'price' => $requestData['price'],
        ];

        // TODO: додати до масиву або БД

        return response()->json(['data' => $newProduct], 201);
    }
}