<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CreateContactRequest;
use App\Services\Backend\AboutService;
use App\Services\Backend\CarouselService;
use App\Services\Backend\ContactService;
use App\Services\Backend\NewsService;
use App\Services\Backend\ProductService;

class IndexController extends Controller
{
    public function __construct(
        private CarouselService $carouselService,
        private AboutService $aboutService,
        private NewsService $newsService,
        private ProductService $productService,
        private ContactService $contactService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['carousels'] = $this->carouselService->findAllForFront();
        $data['about'] = $this->aboutService->findAllForFront();
        $data['news'] = $this->newsService->findAllForFront();
        $data['products'] = $this->productService->findAllForFront();
        return view('frontend.index', ['data' => $data]);
    }

    public function storeContact(CreateContactRequest $request)
    {
        $this->contactService->create($request->all());

        return $this->successResponse(null, 200);
    }
}
