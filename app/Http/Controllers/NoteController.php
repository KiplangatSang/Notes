<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use Exception;

class NoteController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $notes = Note::latest()->get();

        if (!$notes) {
            return $this->sendError('error', 'The items could not be found', 404);
        }

        return $this->sendResponse($notes, 'Items Found', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        //
        $result = Note::create(
            $request->validated(),
        );
        if (!$result) {
            return $this->sendError('error', 'The item could not be created', 404);
        }

        return $this->sendResponse($result, 'The item has been created successfully', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
        $result = $note;

        if (!$result) {
            return $this->sendError('error', 'The item could not be found', 404);
        }

        return $this->sendResponse($result, 'You can show the item', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
        $result = $note;

        if (!$result) {
            return $this->sendError('error', 'The item could not be found', 404);
        }

        return $this->sendResponse($result, 'You can edit the item', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        //

        $result = $note->update(
            $request->validated(),
        );

        if (!$result) {
            return $this->sendError('error', 'The item could not be updated', 404);
        }

        return $this->sendResponse($result, 'The item has been updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //

        // return $note;

        try {
            $result = Note::destroy($note->id);

            if (!$result) {
                return $this->sendError('error', 'The item could not be deleted', 404);
            }

            return $this->sendResponse($result, 'The item  has been deleted', 200);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
