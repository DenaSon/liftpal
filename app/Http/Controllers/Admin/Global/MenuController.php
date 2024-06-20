<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $menuSlugs = ['footer_description', 'company_address','top_description'];

        foreach ($menuSlugs as $slug) {
            Menu::firstOrCreate(
                ['slug' => $slug],
                ['description' => '', 'name' => '']
            );
        }

        $menus = Menu::paginate(getSetting('default_pagination_number'));

        return view('admin.menu.index',compact('menus'));


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
        $request->validate([
            'name'=>'required|string',
            'slug' =>'required|string',
            'description' =>'required|string'
        ]);
        Menu::findOrFail($id)->update($request->only('name', 'slug', 'description'));
        Alert::success('منو با موفقیت ویرایش شد');
        return redirect()->route('menu.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
