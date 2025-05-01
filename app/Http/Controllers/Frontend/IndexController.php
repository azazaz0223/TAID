<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CreateContactRequest;
use App\Services\AboutService;
use App\Services\CarouselService;
use App\Services\ContactService;
use App\Services\CourseService;
use App\Services\JoinService;
use App\Services\NewsService;

class IndexController extends Controller
{
    public function __construct(
        private CarouselService $carouselService,
        private AboutService $aboutService,
        private NewsService $newsService,
        private JoinService $joinService,
        private CourseService $courseService,
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
        $data['joins'] = $this->joinService->findAllForFront();
        $data['courses'] = $this->courseService->findAllForFront();
        return view('frontend.index', ['data' => $data]);
    }

    public function storeContact(CreateContactRequest $request)
    {
        $this->contactService->create($request->all());

        return $this->successResponse(null, 200);
    }
}
