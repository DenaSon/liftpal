<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Milon\Barcode\QRcode;

class BarcodeController extends Controller
{
    public function index(Request $request)
    {



         $request->validate([
             'link'=>'string|url|max:255',
             'type' => 'string|in:QRCODE,DATAMATRIX,PDF417'
         ]);

          return view('admin.store.barcodes.index',);




    }



}
