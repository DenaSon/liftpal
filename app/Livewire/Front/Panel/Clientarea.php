<?php

namespace App\Livewire\Front\Panel;

use Livewire\Component;


class Clientarea extends Component
{

    public $authUser = '';

    public $pageTitle = '';

    public function mount()
    {
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
