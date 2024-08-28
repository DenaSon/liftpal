<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Notifications\sendPasswordNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = $request->input('filter');
        $search = $request->input('search');

        if (isset($filter) && !isset($search))
        {
            $users = User::query()
                ->where(function ($query) {
                    $query->whereNotNull('phone_verified_at')
                        ->orWhereNotNull('email_verified_at');
                })
                ->orderByDesc('created_at')

                ->when($filter, function ($query) use($filter)   {

                    $query->where('role',$filter);

                })


                ->paginate(getSetting('default_pagination_number') ?? 10)->appends(request()->query());

        }

        else
        {
            // Validate and sanitize input values
            $filterOptions = ['phone', 'id', 'email', 'name', 'last_name'];
            $filter = in_array($filter, $filterOptions) ? $filter : null;
            $search = filter_var($search, 513);



            $users = User::query()
                ->where(function ($query) {

                    $query->whereNotNull('phone_verified_at');

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

        }





        return view('admin.user.manager.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            'password' => 'min:8',
             'role' => 'required|string'
        ]);


        try {
            $name = $request->input('name');
            $last_name = $request->input('last_name');
            $password = $request->input('password');
            $notify = $request->input('notify') ?? null;
            $role = $request->input('role');

            $phoneEmail = $request->input('phone_email');
            $user = new User();
            $user->password = Hash::make($password);
            $user->role = $role;

            if (filter_var($phoneEmail, FILTER_VALIDATE_EMAIL)) {
                $existingUser = User::where('email', $phoneEmail)->first('phone');
                if ($existingUser) {
                    Alert::warning('این ایمیل قبلا ثبت شده است.');
                    return redirect()->back();
                }



                $user->email = $phoneEmail;
                $user->save();
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->name = $name;
                $profile->last_name = $last_name;
                $profile->save();
                $user->markPhoneAsVerified();
                $user->markEmailAsVerified();


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
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->name = $name;
                $profile->last_name = $last_name;
                $profile->save();
                $user->markPhoneAsVerified();
                $user->markEmailAsVerified();


                if ($notify) {

                    $template_id = Config::get('sms.notify_template_id');
                    $parameter = new \Cryptommer\Smsir\Objects\Parameters('password',$password);
                    $parameters = array($parameter);
                    sendVerifySms($phoneEmail,$template_id,$parameters);
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

            Alert::success('کاربر جدید ایجاد شد');
            return redirect()->back();
        }
        catch (Throwable $e) {
            setLog('Admin-ProfileCreate', $e->getMessage() . ' ' . $e->getFile(), 'warning');
            return redirect()->route('log-system');
        }




    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'name' => 'nullable|string',
            'last_name' =>'nullable|string',
            'password' => 'nullable|min:8',
            'role' => 'required|string'
        ]);

        try {


            $name = $request->input('name');
            $last_name = $request->input('last_name');
            $password = $request->input('password') ?? null;
            $notify = $request->input('notify') ?? null;
            //$expertise = $request->input('expertise');
            //$gender = $request->input('gender');
            $status = $request->input('userStatus') ?? null;
            $role = $request->input('role') ?? null;

            $user = User::whereId($id)->firstorfail();
            $user->role = $role;
            $profile = $user->profile;
            $profile->name = $name;
            $profile->last_name = $last_name;
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
     */
    public function destroy(string $id)
    {
        $user = User::findorfail($id);


        // Delete associated profile
        if ($user->profile) {
            $user->profile->delete();
        }

        // Delete associated images
        if ($user->images()->exists()) {
            $user->images()->detach();
        }

        // Delete associated wallet
        if ($user->wallet)
        {
            $user->wallet->delete();
        }

        if ($user->comments()->exists()) {
            $user->comments()->delete();
        }



            // Delete the user
        $user->delete();
        Alert::success('کاربر حذف شد','کاربر و تمام اطلاعات مرتبط با آن حذف شدند.');
        return redirect()->back();
    }
}
