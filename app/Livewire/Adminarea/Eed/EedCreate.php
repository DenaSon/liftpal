<?php

namespace App\Livewire\Adminarea\Eed;

use App\Models\Error;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Throwable;

class EedCreate extends Component
{


    public   $code = '', $type = '', $description = '';


    use LivewireAlert,WithPagination,WithoutUrlPagination;

    public function mount()
    {

    }

    public function storeCode()
    {



        try {
            $this->validate(['code' => 'required|string|max:150','type' => 'required|string|max:150','description' => 'required|string|max:1000|min:5']);
            $exists = Error::whereCode($this->code)->whereType($this->type)->first();
            if ($exists)
            {
                $this->alert('error','این خطا از قبل ثبت شده است');
                $this->reset();
            }
            else
            {
                $error = new Error();
                $error->type = $this->type;
                $error->code = $this->code;
                $error->description = $this->description;
                $error->save();
                $this->alert('success','خطا با موفقیت ثبت شد');
                $this->reset();
            }
        }
        catch (Throwable $e)
        {
            $this->alert('error',$e->getMessage());

        }

    }

    public function remove($id)
    {
        Error::findorFail($id)->delete();
        $this->alert('success','خطا حذف شد');
    }
    public function edit($id)
    {

        $this->alert('info','ویرایش ره سی فردا');
    }



    public function render()
    {
        $eedList =  Error::latest('id')->paginate(15);
        return view('livewire.adminarea.eed.eed-create',['eedList' => $eedList]);
    }
}
