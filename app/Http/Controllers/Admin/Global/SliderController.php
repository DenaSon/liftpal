<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class SliderController extends Controller
{
    public function index()
    {

        $sliders = Slider::orderByDesc('created_at')->paginate( getSetting('default_pagination_number' ));
        return view('admin.media.slider.index',compact('sliders'));
    }

    public function show()
    {

    }
    public function create(Request $request)
    {


    }

    public function store(Request $request)
    {
        try {


        $accessCode = $request->input('name');
        $caption = $request->input('caption');

        $slider = new Slider();
        $slider->name = $accessCode;
        $slider->caption = $caption;
        $slider->save();
        Alert::success('اسلایدر جدید ایجاد شد');
        return redirect()->back();
        }
        catch (Throwable $e)
        {
            setLog('Slider-Store',$e->getMessage(),'danger');
            return redirect()->route('log-system');
        }


    }

    public function edit($id,Request $request)
    {


         $slider = Slider::where('id',$id)->firstOrFail();
         return view('admin.media.slider.edit',compact('slider'));


    }

    public function update($id,Request $request)
    {

        $request->validate([
            'interval' =>'numeric|min:500|max:15000'
        ]);

        try {

        $status = $request->input('statusx');
        $link = $request->input('link');
        $touch = $request->input('touch');
        $cycle = $request->input('cycle');
        $hover = $request->input('hover');
        $autoplay = $request->input('autoplay');
        $indicator = $request->input('indicator');
        $interval = $request->input('interval');

        //Update Setting -> Slider
        $slider = Slider::findorfail($id);
        $slider->autoplay_interval = $interval;
        $status == 'active' ? $slider->status = 'active' : $slider->status = 'inactive';
        $touch == 1 ? $slider->touch = 'true' : $slider->touch = 'false';
        $cycle == 1 ? $slider->cycle = 'true' : $slider->cycle = 'false';
        $hover == 1 ? $slider->hover = 1 : $slider->hover = 0;
        $autoplay == 1 ? $slider->autoplay = 'carousel' : $slider->autoplay = '0';
        isset($indicator) && $indicator == 1  ? $slider->indicators = 1 : $slider->indicators = '0';
        $slider->save();

        // Start Images Upload
        if ( $request->hasFile( 'slider' ) ) {

            $request->validate(['slider' =>'image']);


            $slide = $request->file( 'slider' );
            $albumId = 'slider_'.$slider->id;


            if (app()->isLocal())
            {
                $directory = public_path('/media/');
            }
            else
            {
                $directory = ('media');
            }

            $imageName = Str::random( 10 ) .  $slide->getClientOriginalName();
            //Get image size and convert to KB unit
            $fileSize =  $slide->getSize() /1000;
            //Check Max File Size
            if ( $fileSize > getSetting('max_image_size') )
            {
                Alert::warning('خطا','حجم تصویر بیش از حد مجاز است.');
                return redirect()->back();
            }

            $slide->move( $directory , $imageName );

            $uploadedImageNames[] = $imageName;
            $fileName = Str::limit( $albumId  , 18 , '' );
            $imageData = [
                'album_id' => $albumId ,
                'link' => $link ?? null,
                'file_name' => Str::replace( ' ' , '_' , $fileName ) ,
                'file_path' => 'media/' . $imageName ,
                'is_index' => 0 ,
            ];

            $image = Image::create( $imageData );
            $uploadedImageId = $image->id;


            //$product = Product::find($product->id);
            $slider->images()->attach( $uploadedImageId );


            //End Image Upload
        }

        Alert::success('تصویر و تنظیمات ذخیره شدند.');
        return redirect()->back();
        }
        catch(Throwable $e)
        {

            setLog('Slider-Update',$e->getMessage(),'danger');
            return redirect()->route('log-system');
        }



    }

    public function destroy($id)
    {

        try {
        $slider = Slider::findorfail($id);
        $imageFilePaths = $slider->images->pluck('file_path')->toArray();
        // Check file existence in a batch operation
        foreach ($imageFilePaths as $filePath) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $slider->images()->delete();
        $slider->images()->detach();
        $slider->delete();

       Alert::success('اسلایدر حذف شد');
       return redirect()->back();

    }
    catch (Throwable $e)
    {

        setLog('Delete-Slider',$e->getMessage(),'danger');
        return redirect()->route('log-system');
    }
    }



   public function liveDelete($id,Request $request)
   {
       try
       {

           $image = Image::findOrFail($id);
           if ( $image )
           {


               if (app()->isLocal())
               {
                   $image_path = public_path('/media/'.$image->file_path);
               }
               else
               {
                   $image_path = ('media/'.$image->file_path);
               }

               if (file_exists($image_path))
               {

                   unlink( $image_path );
               }

               $image->sliders()->detach();
               $image->delete();

               return response()->json(['message' => 'Image Deleted Successfully'], 200);
           }

           return response()->json(['message' => 'Image not found'], 404);

       }
        catch(Throwable $e)
       {
           setLog('LiveDelete-Slide',$e->getMessage(),'danger');
           return redirect()->route('log-system');
       }
}


}
