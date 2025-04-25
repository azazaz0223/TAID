<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreateProductRequest;
use App\Http\Requests\Backend\UpdateProductRequest;
use App\Models\Product;
use App\Services\Backend\ProductService;
use App\Services\Backend\UploadImageService;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private UploadImageService $uploadImageService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = $this->productService->findAll();
        return view("backend.product.list", ["list" => $list]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("backend.product.detail", ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $data = [
            "title" => $request['title'],
            "subtitle" => $request['subtitle'],
            "content" => $request['content'],
        ];

        $product = $this->productService->create($data);

        $image_url = $this->uploadImageService->uploadImage($product->id, 'product', $request->file('image'));
        $this->productService->update($product->id, ["image" => $image_url]);

        $content_image_url = $this->uploadImageService->uploadImage($product->id . "content", 'product', $request->file('content_image'));
        $this->productService->update($product->id, ["content_image" => $content_image_url]);

        return $this->successResponse(null, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = [
            "title" => $request['title'],
            "subtitle" => $request['subtitle'],
            "content" => $request['content'],
        ];

        $this->productService->update($product->id, $data);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $this->uploadImageService->uploadImage($product->id, 'product', $request->file('image'));
        }

        if ($request->hasFile('content_image') && $request->file('content_image')->isValid()) {
            $this->uploadImageService->uploadImage($product->id . "content", 'product', $request->file('content_image'));
        }

        return $this->successResponse(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->uploadImageService->deleteImage($product->id, 'product');
        $this->productService->delete($product->id);

        return $this->successResponse(null, 200);
    }
}
