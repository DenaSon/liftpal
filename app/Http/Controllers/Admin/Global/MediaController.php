<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class MediaController extends Controller
{
    public function index( Request $request )
    {

        $filter = $request->input('filter') ?? null;

        $images = Image::orderByDesc('created_at')
            ->when($filter != null, function ($query) use($request) {
                // Apply your filter logic here
                $filterValue = $request->input('filter');
                return $query->where('album_id', 'like', "%$filterValue%");
            })
            ->paginate( getSetting('default_pagination_number'))->appends(  request()->query() );

        if (function_exists('disk_free_space') && function_exists('disk_total_space')) {

            $freeSpace = disk_free_space(public_path()) / 1000000;
            $totalSpace = disk_total_space(public_path()) / 1000000;
            $usedSpace = $totalSpace - $freeSpace;
            $usedSpacePercentage = ($usedSpace / $totalSpace) * 100;
            $usedSpacePercentage = number_format($usedSpacePercentage, 2);

            // Store the calculated values for reuse
            $data = [
                'freeSpace' =>  number_format( round($freeSpace)),
                'totalSpace' =>  number_format( round($totalSpace)),
                'usedSpace' =>  number_format( round($usedSpace)),
                'usedSpacePercentage' =>($usedSpacePercentage),
            ];
        }
        else
        {
            $data = [
                'freeSpace' => 0,
                'totalSpace' => 0,
                'usedSpace' => 0,
                'usedSpacePercentage' => 0,
            ];
        }


    return view('admin.media.multimedia.index', compact('data','images'));
    }



  public function store(Request $request)
  {
      $request->validate([

          'image' => 'required'
      ]);

      try
      {
          // Start Images Upload
          if ( $request->hasFile( 'image' ) ) {


              $image = $request->file( 'image' );
              $albumId = 'file_'.rand(100,99999);


              if (app()->isLocal())
              {
                  $directory = public_path('/media/');
              }
              else
              {
                  $directory = ('media');
              }


              $imageName = Str::random( 10 ) .  $image->getClientOriginalName();
              //Get image size and convert to KB unit
              $fileSize =  $image->getSize() /1000;
              //Check Max File Size
              if ( $fileSize > getSetting('max_image_size') )
              {
                  Alert::warning('خطا','حجم تصویر بیش از حد مجاز است.');
                  return redirect()->back();
              }

              $image->move( $directory , $imageName );

              $uploadedImageNames[] = $imageName;
              $fileName = Str::limit( $albumId  , 18 , '' );
              $imageData = [
                  'album_id' => $albumId ,
                  'file_name' => Str::replace( ' ' , '_' , $fileName ) ,
                  'file_path' => 'media/' . $imageName ,
                  'is_index' => 1 ,
              ];

              $image = Image::create( $imageData );



              //End Image Upload
          }

          Alert::success('فایل آپلود شد');
          return redirect()->back();


      }
      catch (Throwable $e)
      {
          setLog('Store-ImageFromMedia',$e->getMessage(),'danger');
          return redirect()->route('log-system');
      }

  }





    public function destroy($id)
    {

        try {


        $image = Image::findOrFail($id);
        $image->delete();
        Alert::success('تصویر حذف شد');
        return redirect()->back();
        }
        catch (Throwable $e)
        {
            setLog('Delete-ImageFromMedia',$e->getMessage(),'danger');
            return redirect()->route('log-system');
        }
    }




}
