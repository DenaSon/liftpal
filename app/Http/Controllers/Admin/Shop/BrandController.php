<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
//use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;



class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderByDesc('created_at')->paginate( getSetting('default_pagination_number') );

        return view('admin.store.brands.index',compact('brands') );
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
        $request->validate([
                'logo'=>'nullable|image',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255'
        ]);

        try {
            Cache::forget('brands');

            $brandName = $request->input('name');
            $brandDescription = $request->input('description');
            $brandLink= $request->input('link');
            $brand = new Brand();
            $brand->name = $brandName;
            $brand->description = $brandDescription;

            $brand->save();
            if ($request->hasFile($request->input('logo'))) {
                $logo = $request->file('logo');
                $albumId = 'logo';


                if (app()->isLocal())
                {
                    $directory = public_path('/media/');
                }
                else
                {
                    $directory = ('media');
                }

                //Get image size and convert to KB unit
                $fileSize = $logo->getSize() / 1000;
                //Check Max File Size
                if ($fileSize > getSetting('max_image_size')) {
                    Alert::warning('حجم تصویر لوگو مجاز نیست.');
                    return redirect()->back();
                }

                $imageName = Str::random(10) . $logo->getClientOriginalName();
                $logo->move($directory, $imageName);
                //$this->optimizeImage($directory,$imageName);

                $fileName = Str::limit($request->input('name'), 18, '...');
                $imageData = [
                    'album_id' => $albumId,
                    'file_name' => Str::replace(' ', '_', $fileName),
                    'file_path' => 'media/' . $imageName,
                    'is_index' => 1,
                ];

                $image = Image::create($imageData);
                $uploadedImageId[] = $image->id;
                $brand->images()->attach($uploadedImageId);


            }
            Alert::success('برند جدید ایجاد شد.');
            return redirect()->back();
        }
        catch (Throwable $e)
        {
            setLog('Store-Brand',$e->getMessage(),'danger');
            return redirect()->route('log-system');
        }

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
            'logo'=>'nullable|image',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255'
        ]);

        try {

            Cache::forget('brands');
            $imageId = $request->input('imageId') ?? null;

            $brandName = $request->input('name');

            $brandDescription = $request->input('description');
            $brand = Brand::findOrFail($id);

            $brand->name = $brandName;

            $brand->description = $brandDescription;
            $brand->save();
            if ($request->hasFile($request->input('logo'))) {
                $logo = $request->file('logo');
                $albumId = 'logo';
                if (app()->isLocal())
                {
                    $directory = public_path('/media/');
                }
                else
                {
                    $directory = ('media');
                }

                //Get image size and convert to KB unit
                $fileSize = $logo->getSize() / 1000;
                //Check Max File Size
                if ($fileSize > getSetting('max_image_size')) {
                    Alert::warning('حجم تصویر لوگو مجاز نیست.');
                    return redirect()->back();
                }

                $imageName = Str::random(10) . $logo->getClientOriginalName();
                $logo->move($directory, $imageName);
               // $this->optimizeImage($directory,$imageName);

                $fileName = Str::limit($request->input('name'), 18, '...');
                $imageData = [
                    'album_id' => $albumId,
                    'file_name' => Str::replace(' ', '_', $fileName),
                    'file_path' => 'media/' . $imageName,
                    'is_index' => 1,
                ];

                if ($imageId && !empty($imageId)) {
                    $image = Image::findOrFail($imageId);

                    if (file_exists($image->file_path)) {
                        unlink($image->file_path);
                    }

                    $image->delete();
                }

                $image = Image::create($imageData);
                $uploadedImageId[] = $image->id;
                $brand->images()->sync($uploadedImageId);


            }
            Alert::success('برند ویرایش شد.');
            return redirect()->back();
        }
        catch (Throwable $e)
        {
            setLog('Update-Brand',$e->getMessage(),'danger');
            return redirect()->route('log-system');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    private function optimizeImage($directory,$imageName)
    {
        $new_directory = $directory . '/' . $imageName;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($new_directory);
        $rectangleWidth = 340;
        $rectangleHeight = 240;
        $image->resize(width: $rectangleWidth, height: $rectangleHeight);



        $imageWidth = $image->width();
        $imageHeight = $image->height();

        $startX = max(0, ($imageWidth - $rectangleWidth) / 2);
        $startY = max(0, ($imageHeight - $rectangleHeight) / 2);

        $image->crop($rectangleWidth, $rectangleHeight, $startX, $startY);
        $image->save(null,95);
    }



}
