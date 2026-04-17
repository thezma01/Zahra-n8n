<?php
namespace App\Http\Controllers;

use App\Http\Resources\StickyNoteResource;
use App\Models\StickyNote;
use Illuminate\Http\Request;

class StickyNoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'size' => 'required|string',
            'shape' => 'required|string',
            'color' => 'required|string',
        ]);

        $stickyNote = StickyNote::create($request->all());

        return response()->json([
            'message' => 'Sticky note created successfully',
            'data' => new StickyNoteResource($stickyNote),
        ], 201);
    }

    public function index()
    {
        $stickyNotes = StickyNote::all();

        return response()->json(StickyNoteResource::collection($stickyNotes));
    }

    public function show(StickyNote $stickyNote)
    {
        return response()->json(new StickyNoteResource($stickyNote));
    }

    public function update(Request $request, StickyNote $stickyNote)
    {
        $request->validate([
            'name' => 'sometimes|required|string',
            'size' => 'sometimes|required|string',
            'shape' => 'sometimes|required|string',
            'color' => 'sometimes|required|string',
        ]);

        $stickyNote->update($request->all());

        return response()->json([
            'message' => 'Sticky note updated successfully',
            'data' => new StickyNoteResource($stickyNote),
        ]);
    }

    public function destroy(StickyNote $stickyNote)
    {
        $stickyNote->delete();

        return response()->json(['message' => 'Sticky note deleted successfully'], 204);
    }
}
