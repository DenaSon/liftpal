<?php
namespace App\Http\Controllers\Admin\User;
use App\Http\Controllers\Controller;
use App\Models\Order;

use App\Models\Profile;
use App\Models\User;
use App\Notifications\sendPasswordNotify;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Morilog\Jalali\Jalalian;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = $request->input('filter');
        $search = $request->input('search');

        // Validate and sanitize input values
        $filterOptions = ['phone', 'id', 'email', 'name', 'last_name', 'expertise'];
        $filter = in_array($filter, $filterOptions) ? $filter : null;
        $search = filter_var($search, 513);



        $users = User::query()->where('role', 'technician')
            ->where(function ($query) {
                $query->whereNotNull('phone_verified_at')
                    ->orWhereNotNull('email_verified_at');
            })
            ->orderByDesc('created_at')

            ->when($filter == 'phone', function ($query) use( $search )  {

                $query->where('phone',$search);

            })
            ->when($filter == 'id', function ($query) use( $search )  {

                $query->where('id',$search);

            })

            ->when($filter == 'email', function ($query) use( $search )  {

                $query->where('email', 'like','%' . $search . '%');

            })

            ->when($filter == 'name', function ($query) use( $search )  {

                $query->whereHas('profile', function ($query) use ( $search ) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
                 })
            ->when($filter == 'last_name', function ($query) use( $search ) {

                $query->whereHas('profile', function ( $query ) use ( $search ) {
                    $query->where('last_name', 'like', '%' . $search . '%');
                });
            })


            ->paginate(getSetting('default_pagination_number') ?? 10)->appends(request()->query());

        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone_email' => 'required',
            'name' => 'string',
            'last_name' =>'string',
            'password' => 'min:8'
        ]);


     try {
    $name = $request->input('name');
    $last_name = $request->input('last_name');
    $password = $request->input('password');
    $notify = $request->input('notify') ?? null;

    $phoneEmail = $request->input('phone_email');
    $user = new User();
    $user->password = Hash::make($password);

    if (filter_var($phoneEmail, FILTER_VALIDATE_EMAIL)) {
        $existingUser = User::where('email', $phoneEmail)->first('phone');
        if ($existingUser) {
            Alert::warning('این ایمیل قبلا ثبت شده است.');
            return redirect()->back();
        }

        $user->email = $phoneEmail;
        $user->save();
        $user->markPhoneAsVerified();
        $user->markEmailAsVerified();
        $user->markRoleAsCustomer();

        if ($notify) {

            $plainPassword = $password;
            $user->notify(new sendPasswordNotify($plainPassword,$user->email));
        }
    }
    elseif (preg_match('/^[0-9]{11}$/', $phoneEmail)) {
        $existingUser = User::where('phone', $phoneEmail)->first('phone');
        if ($existingUser) {
            Alert::warning('این شماره قبلا ثبت نام شده است.');
            return redirect()->back();
        }

        $user->phone = $phoneEmail;
        $user->save();
        $user->markPhoneAsVerified();
        $user->markEmailAsVerified();
        $user->markRoleAsCustomer();

        if ($notify) {
            $notifyTemplate = getSetting('notify_sms_template') ?? 100000;
            sendVerifySms($password, $phoneEmail, $notifyTemplate);
        }
    }
    else
    {
        Alert::warning('شماره یا ایمیل را بصورت صحیح وارد کنید.');
        return redirect()->back()->with('phone_email', 'Error');
    }

    $profile = Profile::where('user_id', $user->id)->first();
    if ($profile) {
        $profile->name = $name;
        $profile->last_name = $last_name;
        $profile->save();
    }

    Alert::success('مشتری جدید ایجاد شد');
    return redirect()->back();
    }
    catch (Throwable $e) {
        setLog('Admin-ProfileCreate', $e->getMessage() . ' ' . $e->getFile(), 'warning');
        return redirect()->route('log-system');
    }

    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//        if(!Gate::allows('admin'))
//        {
//            Alert::warning('دسترسی غیرمجاز','شما اجازه ویرایش اطلاعات کاربر را ندارید.');
//            return redirect()->back();
//        }



        $request->validate([

            'name' => 'nullable|string',
            'last_name' =>'nullable|string',
            'password' => 'nullable|min:8',
            'expertise' => 'nullable|string',
            'gender' => 'in:male,female,other'
        ]);

        try {


        $name = $request->input('name');
        $last_name = $request->input('last_name');
        $password = $request->input('password') ?? null;
        $notify = $request->input('notify') ?? null;
        //$expertise = $request->input('expertise');
        $gender = $request->input('gender');
        $status = $request->input('userStatus') ?? null;

        $user = User::whereId($id)->firstorfail();
        $profile = $user->profile;
        $profile->name = $name;
        $profile->last_name = $last_name;
        //$profile->expertise = $expertise;
        $profile->gender = $gender;
        $profile->push();
        if($password)
        {
            $user->password = Hash::make($password);
        }

        if ($status)
        {
            $user->status = 'banned';
        }
          else
        {
            $user->status = 'unbanned';
        }
          $user->push();

        if( $notify && $password  && $user->phone )
        {
            $notifyTemplate = getSetting('notify_sms_template') ?? 100000;
            sendVerifySms($password, $user->phone , $notifyTemplate,'PASSWORD');
        }
        elseif($notify && $password && $user->email)
        {
            $plainPassword = $password;
            $user->notify( new sendPasswordNotify($plainPassword,$user->email ));
        }

        Alert::success('اطلاعات کاربر ویرایش شد');
        return redirect()->back();
        }
        catch (Throwable $e)
        {
            setLog('Admin-ProfileUpdate',$e->getMessage(). ' File : '. $e->getFile(),'warning');
            return redirect()->route('log-system');
        }


    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(string $id)
    {

      if(!Gate::allows('admin'))
      {
           Alert::warning('دسترسی غیرمجاز','شما اجازه حذف کاربران را ندارید.');
           return redirect()->back();
      }

        try
        {

            $user = User::findorfail($id);


            // Delete associated profile
            if ($user->profile) {
                $user->profile->delete();
            }

            // Delete associated images
            if ($user->images) {
                $user->images->delete();
                $user->images->detach();
            }

            // Delete associated wallet
            if ($user->wallet) {
                $user->wallet->delete();
            }

            // Delete the user
            $user->delete();
            Alert::success('کاربر حذف شد','کاربر و تمام اطلاعات مرتبط با آن حذف شدند.');
            return redirect()->back();


        }
      catch (Throwable $e)
      {
          setLog('Delete-Customer',$e->getMessage(). ' '. $e->getFile(),'danger');
          return redirect()->route('log-system');
      }




    }





}
