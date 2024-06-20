<?php

namespace App\Http\Controllers\Admin\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Property;
use App\Models\Propertyvalue;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Tag;
use App\Models\Type;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
//use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use RealRashid\SweetAlert\Facades\Alert;

use Throwable;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $summary = Product::selectRaw('
        COUNT(CASE WHEN is_active = 1 THEN sku ELSE NULL END) as product_count,
        SUM(CASE WHEN is_active = 1 THEN views ELSE 0 END) as total_views,
        (SELECT COUNT(id) FROM comments WHERE commentable_type = "product" AND status = "hidden" AND created_at >= DATE_SUB(NOW(), INTERVAL 20 DAY)) as comment_count_hidden,
        COUNT(DISTINCT product_category.category_id) as category_count
    ')
            ->leftJoin('product_category', 'products.id', '=', 'product_category.product_id')
            ->first(['sku', 'views','']);


        $productCount = $summary->count() ?? 0;
        $totalViews = $summary->sum('views');
        $commentCount = $summary->comment_count_hidden ?? 0;
        $categoryCount = $summary->category_count ?? 0;
        //$discount = $summary->discount ?? 0;

        // Retrieve query parameters
        $price = $request->query('price', '');
        $views = $request->query('views', '');
        $status = $request->query('status', '');
        $name = $request->query('name', '');
        $category = $request->query('category', '');
        $supplier_id = $request->query('supplier');

        $defaultOrder = 'DESC';
        $priceSort = [
            'desc' => 'product_details.price',
            'asc' => 'product_details.price'
        ];
        $viewsSort = [
            'desc' => 'desc',
            'asc' => 'asc'
        ];


        $productsQuery = Product::select('products.*')

            ->with('categories:id,name')
            ->withCount('categories')
            ->when(isset($priceSort[$price]), function ($query) use ($priceSort, $price) {
                return $query->orderBy($priceSort[$price], $price);
            })
            ->when(isset($viewsSort[$views]), function ($query) use ($viewsSort, $views) {
                return $query->orderBy('views', $viewsSort[$views]);
            })
            ->when($name, function ($query) use ($name) {

                if (is_numeric($name))
                {
                    return $query->where('products.sku', "$name");
                }
                else
                {
                    return $query->where('products.name', 'like', "%$name%");
                }

            })
            ->when($defaultOrder, function ($query) use ($defaultOrder) {
                return $query->orderByDesc('created_at');
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('is_active', $status === 'published' ? 1 : 0);
            })
            ->when($supplier_id, function ($query) use ($supplier_id) {

                // Filter products by supplier_id
                return $query->whereHas('batches', function ($subQuery) use ($supplier_id) {
                    $subQuery->where('supplier_id', $supplier_id);
                });

            })
            ->when($category, function ($query) use ($category) {
                return $query->whereHas('categories', function ($subQuery) use ($category) {
                    $subQuery->where('id', $category);
                });

            });



        $products = $productsQuery->paginate( getSetting('default_pagination_number') ?? 10)->appends( request()->query() );



        return view('admin.store.products.index', compact('products','categoryCount', 'productCount', 'totalViews', 'views','commentCount'));


        }

    /**
     * Show the form for creating a new resource.
     *
     *
  */
    public function create()
{


    $categories = Category::whereType('product')
        ->where('parent_id',null)
        ->orderByDesc('created_at')->limit(400)->get(['id', 'name']);
    $tags = Tag::whereType('product')->orderByDesc('created_at')->limit(150)->get(['id','name']);
    $brands = Brand::orderByDesc('created_at')->limit(150)->get(['id','name']);
    $suppliers = Supplier::orderByDesc('created_at')->limit(100)->get(['id','name']);

    return view('admin.store.products.create', compact(['categories','tags','brands','suppliers']));
}

    /**
     * Store a newly created resource in storage.
     * @param CreateRequest $request
     *
     */
    public function store(CreateRequest $request)
    {


        $request->validate(
            ['images' => 'required']
        );

        // Check the sku code is Unique
        $this->SkuuniqueCheck();

        try {
            Cache::forget('new_products');
            //Start Product Save
        $product = new Product();

        $product->brand_id = $request->input( 'brand' );
        $product->sku = SkuMaker();
        $product->name = $request->input( 'name' );
        $is_featured = $request->input('is_featured') ?? 0;
        $product->details = $request->input( 'details' ) ?? "...";
        $product->description = $request->input( 'description' );
        $product->is_featured =  $is_featured;
        $product->is_active = $request->input( 'status' ) == 'published' ? 1 : 0;
        $product->discount = $request->input('discount');

        $product->unit = $request->input('unit');

       $product->save();

        //End Product  Save
            $typeName = $request->input('optionName', []);
            $typePrice = $request->input('optionPrice', []);
          if (!empty($typeName) && !empty($typePrice))
          {

              //Start Saving Types :
              $typeName = $request->input('optionName', []);
              $typePrice = $request->input('optionPrice', []);


              $product->save();
              foreach ($typeName as $key => $name) {
                  $price = $typePrice[$key];
                  Type::create([
                      'product_id' => $product->id,
                      'name' => $name,
                      'price' => $price,
                  ]);
              }
          }


        //Start Save New Tags :
        $tags = $request->post( 'tags' , [] );
        $tagIds = [];

        // Insert Tags
        $type = 'product';
        foreach ($tags as $tagName) {

            $tag = Tag::firstOrCreate(
                ['name' => $tagName, 'type' => $type],
                ['name' => $tagName, 'type' => $type]
            );

            $product->tags()->attach($tag->id);
        }

        //Start Saving types




        // Start Save New Attributes and Values:
        $properties = $request->input( 'attributeName' , [] );
        $propertyValues = $request->input( 'attributeValue' , [] );

        foreach ( $properties as $index => $property ) {
            // Retrieve the corresponding attribute value for each attribute name
            $propertyValue = $propertyValues[ $index ];

            // Find or create the property
            $propertyModel = Property::firstOrCreate( [ 'name' => $property ] );

            // Find or create the property value associated with the property
            $propertyValueModel = PropertyValue::firstOrCreate( [
                'property_id' => $propertyModel->id ,
                'value' => $propertyValue
            ] );

            //$propertyModelIds[] = $propertyModel->id;
            $propertyValueModelIds[] = $propertyValueModel->id;
        }

        $product->propertyValues()->attach( $propertyValueModelIds );
        //End Save Properties Pivot

        //Start Saving Categories and SubCategories Related to Product ->pivot

        $categoryIds = $request->post( 'categories' , [] );
        $product->categories()->attach( $categoryIds );
        //End Save Categories and SubCategories

        // Start Images Upload
        $uploadedImageIds = [];
        if ( $request->hasFile( 'images' ) ) {
            $images = $request->file( 'images' );
            $albumId = 'product_'.$product->sku;
            if (app()->isLocal())
            {
                $directory = public_path('/media/');
            }
            else
            {
                $directory = ('media');
            }

            foreach ( $images as $image ) {
                $imageName = Str::random( 10 ) . $image->getClientOriginalName();
                //Get image size and convert to KB unit
                $fileSize = $image->getSize() / 1000;
                //Check Max File Size
                if ( $fileSize > getSetting('max_image_size') )
                {
                    continue; // Skip Image That Size > max_image_size
                }

                $image->move( $directory , $imageName );
               // $this->optimizeImage($directory,$imageName);
                $uploadedImageNames[] = $imageName;
                $fileName = Str::limit( $product->name , 18 , '' );
                $imageData = [
                    'album_id' => $albumId ,
                    'file_name' => Str::replace( ' ' , '_' , $fileName ) ,
                    'file_path' => 'media/' . $imageName ,
                    'is_index' => 1 ,
                ];

                $image = Image::create( $imageData );
                $uploadedImageIds[] = $image->id;
            }

            //$product = Product::find($product->id);
            $product->images()->attach( $uploadedImageIds );

        }


      //End Image Upload
        $msg = ' محصول '.$product->name. ' با موفقیت اضافه شد ';
        Alert::success('محصول اضافه شد', $msg);

         return redirect()->route('batch.index',['product_id' => $product->id]);

    }
    catch (Throwable $e)
        {


            setLog('Store-Product',$e->getMessage(),'danger');
            return redirect()->route('log-system');

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

         abort(404);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderByDesc('created_at')->whereType('product')->get();
        $tags = Tag::orderByDesc('created_at')->limit(150)->get(['id','name']);
        $brands = Brand::orderByDesc('created_at')->limit(150)->get(['id','name']);
        $suppliers = Supplier::orderByDesc('created_at')->get(['id','name']);
        $properties = $product->getPropertyValues();
        $types = Type::where('product_id',$product->id)->get();

        return view('admin.store.products.edit',compact(['product','categories','tags','brands','suppliers','properties','types']));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, string $id)
    {


        try {

            Cache::forget('new_products');
        // Check the sku code is Unique
        $this->SkuuniqueCheck();

        //Start Product Update
        $product = Product::findOrFail($id);

        $product->brand_id = $request->input( 'brand' );
        $product->sku = SkuMaker();
        $product->name = $request->input( 'name' );
        $product->details = $request->input( 'details' ) ?? "...";
        $product->description = $request->input( 'description' );
        $product->discount = $request->input('discount');
        $product->unit = $request->input('unit');

        $is_featured = $request->input('is_featured') ?? 0;
        $product->is_featured = $is_featured;
        $product->is_active = $request->input( 'status' ) == 'published' ? 1 : 0;

        $product->save();

            //End Product  Save
            $typeName = $request->input('optionName', []);
            $typePrice = $request->input('optionPrice', []);
            if (!empty($typeName) && !empty($typePrice))
            {
                //Start Saving Types :
                $typeName = $request->input('optionName', []);
                $typePrice = $request->input('optionPrice', []);

                $product->save();
                foreach ($typeName as $key => $name) {
                    $price = $typePrice[$key];
                    Type::create([
                        'product_id' => $product->id,
                        'name' => $name,
                        'price' => $price,
                    ]);
                }
            }




        //Start Update New Tags :
        $tags = $request->input( 'tags' , [] );
        $tagIds = [];

        //Update Tags
        $type = 'product';
        foreach ($tags as $tagName) {

            $tag = Tag::updateOrCreate(
                ['name' => $tagName, 'type' => $type],
                ['name' => $tagName, 'type' => $type]
            );
            $tagIds[] = $tag->id;

        }
        $product->tags()->sync($tagIds);

        // Start Update New Attributes and Values:
        $properties = $request->input( 'attributeName' , [] );
        $propertyValues = $request->input( 'attributeValue' , [] );

        foreach ( $properties as $index => $property ) {
            // Retrieve the corresponding attribute value for each attribute name
            $propertyValue = $propertyValues[ $index ];

            // Find or create the property
            $propertyModel = Property::updateOrCreate( [ 'name' => $property ] );

            // Find or create the property value associated with the property
            $propertyValueModel = PropertyValue::updateOrCreate( [
                'property_id' => $propertyModel->id ,
                'value' => $propertyValue
            ] );

            //$propertyModelIds[] = $propertyModel->id;
            $propertyValueModelIds[] = $propertyValueModel->id;
        }

        $product->propertyValues()->sync( $propertyValueModelIds );
        //End Save Properties Pivot

        //Start Saving Categories and SubCategories Related to Product ->pivot

        $categoryIds = $request->input('categories', []);


        // Update product's category and subcategory associations using sync
        $product->categories()->sync($categoryIds);

        //End Save Categories and SubCategories

        // Start Images Upload
        $uploadedImageIds = [];
        if ( $request->hasFile( 'images' ) ) {
            $images = $request->file('images');

            $albumId = 'product_' . $product->sku;
            if (app()->isLocal())
            {
                $directory = public_path('/media/');
            }
            else
            {
                $directory = ('media');
            }

            foreach ($images as $image) {
                //Get image size and convert to KB unit
                $fileSize = $image->getSize() / 1000;
                //Check Max File Size
                if ($fileSize > getSetting('max_image_size')) {
                    continue; // Skip Image That Size > max_image_size
                }

                $imageName = Str::random(10) . $image->getClientOriginalName();
                $image->move($directory, $imageName);
              //  $this->optimizeImage($directory,$imageName);

                $uploadedImageNames[] = $imageName;
                $fileName = Str::limit($product->name, 18, '');
                $imageData = [
                    'album_id' => $albumId,
                    'file_name' => Str::replace(' ', '_', $fileName),
                    'file_path' => 'media/' . $imageName,
                    'is_index' => 1,
                ];

                $image = Image::create($imageData);
                $uploadedImageIds[] = $image->id;
            }

            //$product = Product::find($product->id);
            $product->images()->attach($uploadedImageIds);

        }


            event(new \App\Events\ProductUpdated($product));


      }
      catch (Throwable $e)
      {
          setLog('Update-Product',$e->getMessage().$e->getFile(),'danger');
          return redirect()->route('log-system');
      }

        Alert::success('محصول بروزرسانی شد','تغییرات با موفقیت اعمال شدند');
        return redirect()->route('products.edit',$product->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            Cache::forget('new_products');
        $product = Product::with('images')->find($id);

        $imageFilePaths = $product->images->pluck('file_path')->toArray();

        // Check file existence in a batch operation
        foreach ($imageFilePaths as $filePath) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Detach and delete models related
        $product->images()->delete();
        $product->images()->detach();
        $product->comments()->delete();
        $product->categories()->detach();
        $product->tags()->detach();
        $product->batches()->delete();
        $product->delete();


        }
        catch (Throwable $e)
        {
            setLog('Delete-Product',$e->getMessage().  ' File :  ' . $e->getFile(),'danger');
            return response()->json(['message' => 'Error happen and logged',],400);
        }

        return response()->json(['message' => 'Product Deleted', 'status' => 200]);

    }


    public function liveRemove(Request $request,$id)
    {
        Cache::forget('new_products');
        $isConfirmed = $request->post('isConfirmed');

        $isConfirmed = request('isConfirmed');
        $image = Image::findOrFail($id);
        $image_link = ( $image->file_path );

        if ( $isConfirmed == 1 && file_exists($image_link )) {

            unlink($image_link);
        }

        $image->products()->detach();
        $image->delete();
        return response()->json(['message' => 'Image deleted successfully']);

    }

    /**
     * Live Validate User Input
     */
    public function live_validator(Request $request): JsonResponse
    {

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [

        'name'      => 'required|min:4|string|max:255' ,
        'brand'     => 'required|exists:brands,id' ,
        'description'    => 'string|min:10|max:160' ,
        'categories'     => 'required|exists:categories,id|max:100' ,
        'tags'  => 'required|max:100' ,
        'discount' => 'numeric|min:0|max:100' ,
        'unit' => 'required|string|min:1|max:35' ,
        'attributeName.*' => 'bail|required|min:1|max:100' ,
        'attributeValue.*' => 'bail|required|min:1|max:100' ,
        'attributeName' => 'bail|required|min:1|max:100' ,
        'attributeValue' => 'bail|required|min:1|max:100' ,
        'optionName.*' => 'required',
        'optionPrice.*' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',

//            'optionName' => 'required',
//          'optionPrice' => 'required',

            // Add more validation rules as needed
        ]);



        if ($validator->fails()) {
            // Validation failed
            return response()->json(

                ['errors' => $validator->errors()],400);

        }


        // Validation passed
        return response()->json(['message' => 'No Error'],200);
    }

    private function SkuuniqueCheck(): void
    {
        try {


        // Check Generated SKU code is UNIQUE
        $maxAttempts = 5; // Maximum number of attempts to generate a unique SKU
        $uniqueSku   = false;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            $sku             = SkuMaker();
            $existingProduct = Product::where('sku' , $sku)->first();

            if (!$existingProduct) {
                $uniqueSku = true;
                break; // Exit the loop if a unique SKU is found
            }
        }

        if (!$uniqueSku) {
            setLog('Sku-Unique',' SKU Cannot UNIQUE After 10 Attempts','danger');
            Log::emergency('Connect To System Programmer. Error : SKU Cannot UNIQUE');

            response()->json(['error' => 'SKU Cannot UNIQUE'], 500);
            exit();
        }
        //End SKU UNIQUE Check
        }
        catch (Throwable $e)
        {
            setLog('Sku-Check',$e->getMessage(). $e->getFile() . ' line : ' . $e->getLine(),'danger');

        }

    }


    private function optimizeImage($directory,$imageName)
    {
        $new_directory = $directory . '/' . $imageName;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($new_directory);
        $rectangleWidth = 510;
        $rectangleHeight = 510;
        $image->resize(width: $rectangleWidth, height: $rectangleHeight);

        $imageWidth = $image->width();
        $imageHeight = $image->height();

        $startX = max(0, ($imageWidth - $rectangleWidth) / 2);
        $startY = max(0, ($imageHeight - $rectangleHeight) / 2);

        $image->crop($rectangleWidth, $rectangleHeight, $startX, $startY);
        $image->place('media/6dp7SSMnrplogo-product.png','top-right',5,5);
        $image->save(null,99);
    }




}
