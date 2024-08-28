<?php

namespace App\Livewire\Adminarea;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class adminPanel extends Component
{
    use LivewireAlert;

    public $authUser;
    public $messagesCount = 0;

    public $pageTitle=  '';


    private function setPageTitle()
    {
        $activePage = request()->input('page', '') ?? '';
        switch ($activePage)
        {
            case 'allot':
                $this->pageTitle = 'تخصیص';
                break;
            case 'dashboard':
                $this->pageTitle = 'داشبورد';
                break;

            default:

                $this->redirectRoute('management',['page'=>'main']);
        }


    }

    public function mount()
    {
        $this->authorize('admin-access');
        $this->authUser = auth()->user();
    }
    public function render()
    {
        $this->authorize('admin-access');
        $this->setPageTitle();
        $pageTitle = $this->pageTitle;
        return view('livewire.adminarea.admin-panel')->title($pageTitle ?? '');
    }


}
