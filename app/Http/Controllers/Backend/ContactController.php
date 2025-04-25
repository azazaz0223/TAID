<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\FindContactRequest;
use App\Http\Requests\Backend\UpdateContactRequest;
use App\Models\Contact;
use App\Services\Backend\ContactService;

class ContactController extends Controller
{
    public function __construct(
        private ContactService $contactService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(FindContactRequest $request)
    {
        $list = $this->contactService->findAll($request);
        return view('backend.contact.list', ['list' => $list]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $this->contactService->update($contact, $request->all());

        return $this->successResponse(null, 200);
    }
}
