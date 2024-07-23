<?php

namespace App\Http\Controllers\Admin\Elevator;

use App\Http\Controllers\Controller;
use App\Models\Error;
use Illuminate\Http\Request;

class eedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eed_errors = Error::paginate(20);

        return view('admin.elevator.eed.index',compact('eed_errors'));
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
    public function store(Request $request)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:errors,code',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create a new error record
        $error = new Error();
        $error->code = $validatedData['code'];
        $error->type = $validatedData['type'];
        $error->description = $validatedData['description'];
        $error->save();

        // Redirect or return a response
        return redirect()->route('eed.index')->with('success', 'Error created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the item by ID
        $eed = Error::findOrFail($id);

        // Delete the item
        $eed->delete();

        // Redirect back with a success message
        return redirect()->route('eed.index')->with('success', 'Item deleted successfully.');
    }
}
