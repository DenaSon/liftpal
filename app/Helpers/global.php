<?php

use App\Models\Address;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Log;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Tag;
use Cryptommer\Smsir\Objects\Parameters;
use Cryptommer\Smsir\Smsir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Morilog\Jalali\Jalalian;
use Pishran\Zarinpal\Zarinpal;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| Global Functions
|--------------------------------------------------------------------------
|| Here is for common website functions as helper . These
| functions are loaded by the laravel in everywhere  and all of them will
| be assigned to the "Setting" model .
|*/



/**
 * Random Code Generator based on Date and 3 random numbers.
 *
 * @param int $end
 * @return String
 *
 * @throws Exception
 */
function SkuMaker(int $end = 9999): string
{

    try {
        $currentDate = date('ymNi');
        $random_int = random_int(1000, $end);
        $additionalRandom = rand(1, 9); // Additional random number

        return $currentDate . $random_int . $additionalRandom;
    }
    catch (Exception $e) {

        setLog('Make-Sku',$e->getMessage(),'danger');

        return 'Error';
    }

}


/**
 * Send SMS API
 *
 *@param string $value
 * @param string $phoneNumber
 * @param int $templateID
 * @param string $parameterName
 * @return mixed
 */

function sendSms(string $value, string $phoneNumber, int $templateID, string $parameterName)
{

    try {

        $send = Smsir::send();
        $parameter = new Parameters($parameterName, $value);
        $parameters = array($parameter);
        $response = $send->Verify($phoneNumber, $templateID, $parameters);

    }
    catch (Throwable $e)
    {
        $errorMessage = $e->getMessage();
        setLog('Send-Sms', $errorMessage . ' | Source : ' . $e->getFile() . ' | Line : ' . $e->getLine(), 'danger');


    }

}






/**
* Send SMS API
*

* @param string $phoneNumber
* @param int $templateID
* @param array|string $parameterName
* @return mixed
*/

function sendVerifySms( string $phoneNumber, int $templateID, array $parameters)
{
    $send = Smsir::send();

    // Send the verification SMS with the generated parameters
    $response = $send->Verify($phoneNumber, $templateID, $parameters);


}

/**
 * Zarinpal Payment
 *
 * @param int $amount
 * @param string $description
 * @param string $callbackUrl
 * @param string $mobile
 * @param string $email
 * @return mixed
 */
function sendPayment(int $amount, string $description, string $callbackUrl, string $mobile = '', string $email = ''): mixed
{
    try {
        $response = zarinpal()
            ->amount($amount)
            ->request()
            ->description($description)
            ->callbackUrl($callbackUrl)
            ->mobile($mobile)
            ->email($email)
            ->send();

        if ( !$response->success() )
        {
            $message = $response->error()->message();
            setLog('Send-Payment', $message, 'warning');
            return redirect()->back();
        }

         return $response->redirect();


    }
    catch (Throwable $e)
    {
        setLog('Send-Payment', $e->getMessage() . ' | Source : '.$e->getFile() . ' | Line : '. $e->getLine(), 'danger');
        return false;
    }


}

/**
 * Filter Product Based on Properties and Properties Values
 *
 * @param string $attributeName
 * @param string $attributeValue
 * @param string $field
 * @param int $limit
 * @param string $orderField
 * @param string $order
 * @return mixed
 */
function filterProduct(string $attributeName, string $attributeValue, string $field = '', int $limit = 100, string $orderField='created_at', string $order = 'DESC'): mixed
{
    // Prepare the query with parameter binding
    $query = Product::query()
        ->join('property_propertyvalue_product', 'products.id', '=', 'property_propertyvalue_product.product_id')
        ->join('propertyvalues', 'property_propertyvalue_product.propertyvalue_id', '=', 'propertyvalues.id')
        ->join('properties', 'propertyvalues.property_id', '=', 'properties.id')
        ->where('properties.name', '=', $attributeName)
        ->where('propertyvalues.value', '=', $attributeValue);

    if (!empty($field)) {
        $query->select('products.' . $field);
    }

    $query->limit($limit);

    if (!empty($orderField) && in_array($orderField, ['created_at', 'updated_at','id'])) {
        $query->orderBy('products.'.$orderField, $order);
    }

    if ($limit === 1) {
        return $query->first();
    }

    return $query->paginate($limit);
}


/**
 * Get Setting Value Based On Setting Key
 *
 * @param string|null $key
 * @return mixed
 */
function getSetting(string $key = null): mixed
{
    $minutes = 60 * 10;
    $setting = Cache::remember('settings_' . $key, $minutes, function () use ($key) {
        return Setting::where('key', $key)->value('value');
    });

    return $setting ?? null;
}

/**
 * Set Log and report to programmer
 *
 */
function setLog($action = null, $description = null, $severity = null)
{

    try {

        $logOnOff = getSetting('log_on_off');
        if ($logOnOff == 'on') {
            $log = new Log();
            $user_id = Auth::check() ? Auth::id() : null;
            $request = request();
            $log->user_id = $user_id;
            $log->action = $action;
            $log->description = $description;
            $log->ip_address = $request->ip();
            $log->request_payload = json_encode($request->all()); // Convert request data to JSON

            $log->user_agent = $request->userAgent();
            $log->severity = $severity;
            $log->save();

        }

    }
    catch (Throwable $e)
    {

        Log::error('Failed to save log entry: ' . $e->getMessage());

    }

}
/**
 * @param $datetime
 * @return string
 */
function toSystemDate($datetime)
{
    $jalaliDate = Jalalian::fromFormat('Y-m-d H:i', $datetime);
    $gregorianDate = $jalaliDate->toCarbon();
    return $gregorianDate->format('Y-m-d H:i:s');
}
/**
 * @param $date
 * @return string
 */
function toSystemDateOnly($date)
{
    $jalaliDate = Jalalian::fromFormat('Y-m-d', $date);
    $gregorianDate = $jalaliDate->toCarbon();
    return $gregorianDate->format('Y-m-d');
}




function getMenu(string $slug = null): mixed
{
    $menu = Cache::remember('menu_' . $slug, 60 * 10 , function () use ($slug) {
        return Menu::where('slug', $slug)->value('description');
    });

    return $menu ?? null;
}


function slugMaker($string)
{
    // Convert string to lowercase
    $slug = strtolower($string);

    // Replace special characters or spaces with a dash
    $slug = preg_replace('/[^\p{L}\p{N}]+/u', '-', $slug);

    // Remove multiple dashes
    $slug = preg_replace('/-+/', '-', $slug);

    // Remove leading/trailing dashes
    $slug = trim($slug, '-');

    return $slug;
}


function getPagesName($location)
{

    $pages = Cache::remember('pages',60 * 10,function() use($location)
    {
        return Page::select(['id','title','slug','location'])
            ->where('is_active',true)
            ->where('location',$location)
            ->orderByDesc('created_at')->get();
    });

    return $pages ?? null;
}


function getCategories()
{
    $categories = Cache::remember('product_categories', 60 * 10, function () {
        return Category::with(['subcategories' => function ($query) {
            $query->with('products', 'subcategories.products', 'subcategories.subcategories.products');
        }])
            ->where('type', 'product')
            ->whereNull('parent_id')
            ->get();
    });

    return $categories ?? collect(); //default
}


function getPostTags()
{

    $tags = Cache::remember('post_tags',60 * 10,function ()
    {
        return Tag::select(['id', 'name', 'type','views'])
            ->where('type', 'post')
            ->orderBy('views', 'desc')
            ->get();
    });

    return $tags ?? null;
}




function getBrands($limit = 10)
{
    $brands =  Cache::remember('brands', 60 * 10, function () use ($limit) {
        return Brand::take($limit)->get();
    });
    return $brands ?? null;

}

function getProducts()
{
    $cacheKey = 'new_products';
    $cacheDuration = 60 * 10; // 10 minutes

    if (Cache::has($cacheKey)) {
        return Cache::get($cacheKey);
    }

    $products = Product::active()

        ->get();

    Cache::put($cacheKey, $products, $cacheDuration);

    return $products;
}


function getPosts()
{
    $cacheKey = 'new_posts';
    $cacheDuration = 60 * 10; // 10 minutes

    if (Cache::has($cacheKey)) {
        return Cache::get($cacheKey);
    }

    $posts = Post::
    orderBy('views')
        ->get();

    Cache::put($cacheKey, $posts, $cacheDuration);

    return $posts;
}


function getArticleReadTime($text='abc', $division=100,$locale = 'fa')
{
   $str =  Str::length($text);
   $length = round($str / $division,0,PHP_ROUND_HALF_DOWN) ?? 1;
   $result = Number::spell($length,$locale);

   return $result ?? 0;
}

function userAddressExist($authId): bool
{
    //get user address
    $addressExists = (bool) Address::whereUserId($authId)->whereIsDefault(1)->first();

    return $addressExists;
}


 function imageOptimizer($directory,$imageName,$rectangleWidth,$rectangleHeight,$quality=90)
{
    $new_directory = $directory . '/' . $imageName;
    $manager = new ImageManager(new Driver());
    $image = $manager->read($new_directory);
    $image->resize(width: $rectangleWidth, height: $rectangleHeight);

    $imageWidth = $image->width();
    $imageHeight = $image->height();

    $startX = max(0, ($imageWidth - $rectangleWidth) / 2);
    $startY = max(0, ($imageHeight - $rectangleHeight) / 2);
    $image->crop($rectangleWidth, $rectangleHeight, $startX, $startY);
    $image->save(null,$quality);
}


function formatPhoneNumber($phoneNumber)
{
    if (strlen($phoneNumber) === 11) {

        return substr($phoneNumber, 0, 4) . '-' .
            substr($phoneNumber, 4, 3) . '-' .
            substr($phoneNumber, 7, 4);
    }
    else
    {
        return $phoneNumber;
    }
}

/**
 * Convert persian numbers to system(english) numbers
 *
 * @param int $value
 * @return numeric
 *
 * @throws Exception
 */
function convertPersianNumbers($string): float|int|string
{
    try {
        $persian_numbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english_numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($persian_numbers, $english_numbers, $string);
    }
    catch (Throwable $e)
    {
        \Illuminate\Support\Facades\Log::error($e->getMessage());
    }
}
