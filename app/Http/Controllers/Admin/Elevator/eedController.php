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
        $errors = Error::paginate(20);

        return view('admin.elevator.eed.index',compact('errors'));
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
        //
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
        //
    }
}
