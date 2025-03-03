<?php

namespace App\Livewire\Front\Panel;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;


class Clientarea extends Component
{
    use WithFileUploads,LivewireAlert;

    public $authUser = '';

    public $pageTitle = '';

    #[Validate('image|max:1024')] // 1MB Max

    public $photo =null;
    public $messagesCount = 0;


    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:512', // Ensure file is an image and not larger than 512 KB
        ]);

        if ($this->photo) {
            // Generate a unique name for the image
            $imageName = Str::random(10) . '_' . $this->photo->getClientOriginalName();


            if (app()->isLocal()) {
                $directory = 'media';
                $disk = 'public';
            } else {
                $directory = '';
                $disk = 'public_html_media';
            }

            // Ensure the directory exists
            if (!Storage::disk($disk)->exists($directory)) {
                Storage::disk($disk)->makeDirectory($directory);
            }

            $path = $this->photo->storeAs($directory, $imageName, $disk);

            try {
                $this->optimizeImage($directory, $imageName);
            }
            catch (\Exception $e) {

                $this->alert('warning',$e->getMessage());
                setLog('Upload-Profile-Optimize',$e->getMessage(),'danger');
            }


            $albumId = 'profile_' . Auth::id();
            $imageData = [
                'album_id' => $albumId,
                'file_name' => Str::replace(' ', '_', Str::limit($imageName, 18, '')),
                'file_path' => $disk === 'public' ? 'storage/' . $path : 'media/' . $path, // Adjust the path based on disk
                'is_index' => 0,
            ];

            // Save the image to the database
            $image = Image::create($imageData);

            // Attach the image to the authenticated user
            Auth::user()->images()->save($image);

            // Flash success message
            $this->alert('success', 'تصویر پروفایل آپلود شد');
            $this->redirectRoute('panel');
        }
    }



    public function mount()
    {
        $this->photo = auth()->user()->images?->first()?->file_path ?? null;
        $this->messagesCount = auth()->user()->messages()->where('is_read',0)->count();
        $this->authUser = auth()?->user();
        $this->setPageTitle();
    }


    private function optimizeImage($directory,$imageName)
    {
        $new_directory = $directory . '/' . $imageName;
        $manager = new ImageManager(new Driver());
        $image = $manager->read($new_directory);
        $rectangleWidth = 180;
        $rectangleHeight = 190;
        $image->resize(width: $rectangleWidth, height: $rectangleHeight);

        $imageWidth = $image->width();
        $imageHeight = $image->height();

        $startX = max(0, ($imageWidth - $rectangleWidth) / 2);
        $startY = max(0, ($imageHeight - $rectangleHeight) / 2);
        $image->crop($rectangleWidth, $rectangleHeight, $startX, $startY);
        $image->save(null,90);
    }

    private function setPageTitle()
    {
        $activePage = request()->input('page', '') ?? '';
        switch ($activePage) {
            case 'main':
                $this->pageTitle = 'خلاصه فعالیت‌ها';
                break;
            case 'profile':
                $this->pageTitle = 'ویرایش پروفایل';
                break;
            case 'favorite':
                $this->pageTitle = 'مورد علاقه‌ها';
                break;
            case 'invoice':
                $this->pageTitle = 'صورتحساب';
                break;
            case 'support':
                $this->pageTitle = 'پشتیبانی';
                break;
            case 'address':
                $this->pageTitle = 'آدرس‌ها';
                break;
            case 'notification':
                $this->pageTitle = 'اطلاعیه‌ها';
                break;
            case 'building':
                $this->pageTitle = 'مدیریت ساختمان';
                break;
            case 'fault-alert':
                $this->pageTitle = 'اعلام خرابی آسانسور';
                break;
            case 'get-location':
                $this->pageTitle = 'ثبت آدرس ساختمان';
                break;
            case 'request-list':
                $this->pageTitle = 'لیست درخواست ها';
                break;
            case 'messages':
                $this->pageTitle = 'پیام‌های دریافتی';
                break;
            case 'company-dashboard':
                $this->pageTitle = 'داشبورد شرکت';
                break;
            case 'technician-allot':
                $this->pageTitle = 'انتساب کارشناس فنی';
                break;
            case 'company-buildings':
                $this->pageTitle = 'ساختمان‌ها';
                break;
            case 'company-technicians':
                $this->pageTitle = 'مدیریت کارشناس‌ها ';
                break;
            default:
                $this->redirectRoute('panel', ['page' => 'main']);
        }


    }


    public function render()
    {
        $prefix = 'پنل کاربری | ';

        return view('livewire.front.panel.clientarea')->title($prefix . $this->pageTitle);
    }
}
