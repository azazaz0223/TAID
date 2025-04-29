<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreateCourseRequest;
use App\Http\Requests\Backend\UpdateCourseRequest;
use App\Models\Course;
use App\Services\Backend\CourseService;
use App\Services\Backend\UploadImageService;

class CourseController extends Controller
{
    public function __construct(
        private CourseService $courseService,
        private UploadImageService $uploadImageService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = $this->courseService->findAll();
        return view("backend.course.list", ["list" => $list]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view("backend.course.detail", ['course' => $course]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCourseRequest $request)
    {
        $data = [
            "title" => $request['title'],
            "subtitle" => $request['subtitle'],
            "content_text" => $request['content_text'],
            "status" => $request['status'],
            "sort" => $request['sort'] ?? 1
        ];

        $course = $this->courseService->create($data);

        $image_url = $this->uploadImageService->uploadImage($course->id, 'course', $request->file('image'));
        $content_image_url = $this->uploadImageService->uploadImage($course->id . "content", 'course', $request->file('content_image'));

        $this->courseService->update($course->id, ["image" => $image_url, "content_image" => $content_image_url]);

        return $this->successResponse(null, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = [
            "title" => $request['title'],
            "subtitle" => $request['subtitle'],
            "content_text" => $request['content_text'],
            "status" => $request['status'],
            "sort" => $request['sort'] ?? 1
        ];

        $this->courseService->update($course->id, $data);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $this->uploadImageService->uploadImage($course->id, 'course', $request->file('image'));
        }

        if ($request->hasFile('content_image') && $request->file('content_image')->isValid()) {
            $this->uploadImageService->uploadImage($course->id . "content", 'course', $request->file('content_image'));
        }

        return $this->successResponse(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $this->uploadImageService->deleteImage($course->id, 'news');
        $this->courseService->delete($course->id);

        return $this->successResponse(null, 200);
    }
}
