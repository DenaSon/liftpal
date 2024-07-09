<?php

namespace App\Livewire\Front\Panel;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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


    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        if ($this->photo) {
            // Generate a unique filename
            $imageName = Str::random(10) . '_' . $this->photo->getClientOriginalName();

            // Determine the correct directory
            $directory = 'media';

            // Store the file in the 'public/media' directory
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Store the file in the 'public/media' directory
            $path = $this->photo->storeAs($directory, $imageName, 'public');

            // Prepare the image data for saving
            $albumId = 'blog_' . Auth::id();
            $imageData = [
                'album_id' => $albumId,
                'file_name' => Str::replace(' ', '_', Str::limit($imageName, 18, '')),
                'file_path' => $path,
                'is_index' => 0,
            ];

            // Save the image to the database
            $image = Image::create($imageData);

            // Attach the image to the authenticated user
            Auth::user()->images()->save($image);
        }

        // Flash success message
        alert()->flash('success', 'Photo successfully uploaded.');
    }

    public function mount()
    {
        $this->photo = auth()->user()->images?->first()?->file_path ?? null;

        $this->authUser = auth()?->user();
        $this->setPageTitle();
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
