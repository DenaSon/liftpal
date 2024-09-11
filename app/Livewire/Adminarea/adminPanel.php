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
            case 'companies':
                $this->pageTitle = 'مدیریت شرکت';
                break;
            case 'user-manager':
                $this->pageTitle = 'مدیریت کاربران';
                break;
            case 'dashboard':
                $this->pageTitle = 'داشبورد';
                break;
            case 'eed-create':
                $this->pageTitle = 'سیستم کشف خطا EED';
                break;

            default:

               abort(404);
        }


    }

    public function mount()
    {

        if (request()->input('page') == null)
        {
            return redirect()->route('management',['page' =>'dashboard']);
        }


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
