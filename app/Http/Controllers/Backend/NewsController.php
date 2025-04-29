<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreateNewsRequest;
use App\Http\Requests\Backend\UpdateNewsRequest;
use App\Models\News;
use App\Services\NewsService;
use App\Services\UploadImageService;

class NewsController extends Controller
{
    public function __construct(
        private NewsService $newsService,
        private UploadImageService $uploadImageService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = $this->newsService->findAll();
        return view("backend.news.list", ["list" => $list]);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view("backend.news.detail", ['news' => $news]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewsRequest $request)
    {
        $data = [
            "title" => $request['title'],
            "subtitle" => $request['subtitle'],
            "content_text" => $request['content_text'],
            "status" => $request['status'],
            "sort" => $request['sort'] ?? 1
        ];

        $news = $this->newsService->create($data);

        $image_url = $this->uploadImageService->uploadImage($news->id, 'news', $request->file('image'));
        $content_image_url = $this->uploadImageService->uploadImage($news->id . "content", 'news', $request->file('content_image'));

        $this->newsService->update($news->id, ["image" => $image_url, "content_image" => $content_image_url]);

        return $this->successResponse(null, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $data = [
            "title" => $request['title'],
            "subtitle" => $request['subtitle'],
            "content_text" => $request['content_text'],
            "status" => $request['status'],
            "sort" => $request['sort'] ?? 1
        ];

        $this->newsService->update($news->id, $data);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $this->uploadImageService->uploadImage($news->id, 'news', $request->file('image'));
        }

        if ($request->hasFile('content_image') && $request->file('content_image')->isValid()) {
            $this->uploadImageService->uploadImage($news->id . "content", 'news', $request->file('content_image'));
        }

        return $this->successResponse(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $this->uploadImageService->deleteImage($news->id, 'news');
        $this->newsService->delete($news->id);

        return $this->successResponse(null, 200);
    }
}
