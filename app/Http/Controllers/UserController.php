<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roll;
use App\Models\Level;
use App\Rules\contactNo;
use App\Models\Privilege;
use App\Rules\nationalID;
use Illuminate\Support\Str;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $users = User::join('rolls', 'users.roll_id', '=', 'rolls.id')->select('users.id as id', 'users.name as user_name', 'users.email as user_email', 'rolls.name as roll_name')->get();
        $level = Level::get();
        $pageAuth = $user->authentication(config('auth.privileges.userCreate'));
        //        Log::channel('daily')->info('User of' . $user->name . 'is authorized for an user create');
        return view('user', ['levels' => $level, 'users' => $users, 'pageAuth' => $pageAuth]);
    }

    //    public function __construct()
    //    {
    //        $this->middleware('auth');
    //    }

    public function create(Request $request)
    {
        $req = $request->all();
        $req_string = json_encode($req);
        Log::channel('daily')->info('User Save Request ->' . $req_string);
        \DB::transaction(function () {
            $msg = false;
            request()->validate([
                'firstName' => 'required|max:50|string',
                'lastName' => 'sometimes|nullable|max:50|string',
                'address' => 'sometimes|max:100',
                'contactNo' => ['nullable', new contactNo],
                'email' => 'required|email',
                'nic' => ['sometimes', 'nullable', 'unique:users', new nationalID],
                'roll' => 'integer|required',
                'password' => 'required|confirmed|min:6',
                // 'institute' => 'required|integer',
            ]);
            //            Log::channel('daily')->info('User details validated');
            $user = new User();
            $user->email = request('email');
            $user->name = request('firstName');
            $user->last_name = request('lastName');
            $user->address = request('address');
            $user->contact_no = request('contactNo');
            $user->nic = request('nic');
            $user->roll_id = request('roll');
            $user->password = Hash::make(request('password'));
            $user->save();
            UserController::PrevilagesAdd($user);
            //            LogActivity::addToLog('Save User : UserController', $user);
        });
        //        Log::info('User_has_created Successfully ->');
        return redirect()
            ->back()
            ->with('success', 'Ok');
    }

    public function edit(Request $request, $id)
    {
        $aUser = Auth::user();
        $user = User::findOrFail($id);

        $level = $user->roll->level;
        $privileges = Privilege::get();
        $roles = Level::find($user->roll->level_id)->rolls;
        $activity = array(
            'ACTIVE' => User::ACTIVE,
            'INACTIVE' => User::INACTIVE,
            'ARCHIVED' => User::ARCHIVED,
        );
        $pageAuth = $aUser->authentication(config('auth.privileges.userCreate'));
        //        Log::channel('daily')->info('User details for user_update view has transfered');
        return view('user_update', ['level' => $level, 'user' => $user, 'privileges' => $privileges, 'roles' => $roles, 'activitys' => $activity, 'pageAuth' => $pageAuth]);
    }

    public function PrevilagesAdd($user)
    {
        $privileges = $user->roll->privileges;
        //        dd($privileges);
        foreach ($privileges as $value) {
            //           echo $value['id'] . request('roll_id') . "</br>";
            $user->privileges()->attach(
                $value['id'],
                [
                    'is_read' => $value['pivot']['is_read'],
                    'is_create' => $value['pivot']['is_create'],
                    'is_update' => $value['pivot']['is_update'],
                    'is_delete' => $value['pivot']['is_delete'],
                ]
            );
        }
        Log::channel('daily')->info('Privillege_addition_successfull ->' . $user);
    }

    public function PrevilagesAddById(Request $request, $id)
    {
        $req = $request->all();
        $req_string = json_encode($req);
        Log::channel('daily')->info('Privillege_add_by_id_request ->' . $req_string);
        $privileges = $request->all()['pre'];
        //        dd($privileges);
        $user = User::findOrFail($id);
        request()->validate([
            'role' => 'integer|required',
        ]);
        $user->roll_id = request('role');
        $user->save();
        $user->privileges()->detach();
        foreach ($privileges as $value) {
            $user->privileges()->attach(
                $value['id'],
                [
                    'is_read' => $value['is_read'],
                    'is_create' => $value['is_create'],
                    'is_update' => $value['is_update'],
                    'is_delete' => $value['is_delete'],
                ]
            );
        }
        Log::channel('daily')->info('Privillege_add_by_id_save ->' . $user);
        return array('id' => '1', 'msg' => 'ok');
    }

    public function store(Request $request, $id)
    {
        $req = $request->all();
        $req_string = json_encode($req);
        Log::channel('daily')->info('User_Update_Request ->' . $req_string);
        $user = User::findOrFail($id);
        //        request()->validate([
        //            'firstName' => 'required|max:50|alpha',
        //            'lastName' => 'required|max:50|alpha',
        //            'userName' => 'required|max:50|alpha_dash|unique:users,user_name',
        //            'address' => 'max:100|alpha',
        //            'contactNo' => 'max:12',
        //            'email' => 'email',
        //            'nic' => 'max:12|unique:users,3'
        //        ]);
        //        dd($user);
        //        $user->user_name = request('userName');
        $user->name = request('firstName');
        $user->last_name = request('lastName');
        $user->address = request('address');
        $user->contact_no = request('contactNo');
        $user->email = request('email');
        $user->nic = request('nic');
        $msg = $user->save();


        if ($msg) {
            Log::channel('daily')->info('Update_User_Done: UserController ->' . $user . '');
            //            LogActivity::addToLog('Update User Done: UserController', $user);
        } else {
            Log::channel('daily')->info('Update_User_Fail : UserController ->' . $user . '');
            //            LogActivity::addToLog('Update User Fail : UserController', $user);
        }


        if ($msg) {
            //            Log::channel('daily')->info('Success Status has sended on update user');
            return redirect()
                ->back()
                ->with('success', 'Ok');
        } else {
            //            Log::channel('daily')->debug('Success Status could not send due to error on update user');
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error');
        }
        Log::channel('daily')->info('User Privileges has assigned');
        //        LogActivity::addToLog('Assign User Privileges', $user);
    }

    public function storePassword(Request $request, $id)
    {
        $req = $request->all();
        $req_string = json_encode($req);
        Log::channel('daily')->info('Store_password_Request ->' . $req_string);
        $user = User::findOrFail($id);
        request()->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        Log::channel('daily')->info('Password has validated');
        $user->password = Hash::make(request('password'));
        $msg = $user->save();


        if ($msg) {
            Log::channel('daily')->info('Store Password Done: UserController');
            //            LogActivity::addToLog('Store Password Done: UserController', $user);
        } else {
            Log::channel('daily')->info('Store Password Fail: UserController');
            //            LogActivity::addToLog('Store Password Fail: UserController', $user);
        }

        if ($msg) {
            //            Log::channel('daily')->info('Success Status has sended on store password');
            return redirect()
                ->back()
                ->with('success', 'Ok');
        } else {
            //            Log::channel('daily')->debug('Success Status could not send due to error on store password');
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error');
        }
    }

    public function activeStatus(Request $request, $id)
    {
        $req = $request->all();
        $req_string = json_encode($req);
        Log::channel('daily')->info('Active_Status_Request ->' . $req_string);
        $user = User::findOrFail($id);
        //        return $request;
        //        request()->validate([
        //            'password' => 'required|confirmed|min:6'
        //        ]);
        // need to write a validation rule to recstict input
        //        return $request['status'];
        switch ($request['status']) {
            case 'ACTIVE':
                $user->activeStatus = User::ACTIVE;
                return array('id' => 1, 'msg' => 'success');
                break;
            case 'INACTIVE':
                $user->activeStatus = User::INACTIVE;
                return array('id' => 1, 'msg' => 'success');
                break;
            case 'ARCHIVED':
                $user->activeStatus = User::ARCHIVED;
                return array('id' => 1, 'msg' => 'success');
                break;
            default:
                return array('id' => 2, 'msg' => 'invalid Input');
        }
        $user->save();
        Log::channel('daily')->info('Update_active_user_status_successfull' . $user);
    }

    public function previlagesById($id)
    {
        $user = User::findOrFail($id);
        //        Log::channel('daily')->info('Successfully load the privilleges by id');
        return $user->privileges;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $msg = $user->delete();
        $users = User::with('roll')->get();
        $level = Level::get();
        $Auser = Auth::user();
        $pageAuth = $Auser->authentication(config('auth.privileges.userCreate'));
        if ($msg) {
            Log::channel('daily')->info('Delete Done: user->' . $user . 'msg ->' . $msg);
            //            LogActivity::addToLog('Delete Done: UserController', $user);
        } else {
            Log::channel('daily')->info('Delete fail: user->' . $user . 'msg ->' . $msg);
            //            LogActivity::addToLog('Delete fail: UserController', $user);
        }
        return view('user', ['levels' => $level, 'users' => $users, 'pageAuth' => $pageAuth]);
    }

    public function logout()
    {
        $user = Auth::user();
        Auth::logout();
        Log::channel('daily')->info('User_logged_out ->' . $user);
        return redirect('/');
        //        $this->middleware('auth');
    }

    public function myProfile()
    {
        $aUser = Auth::user();
        $pageAuth = $aUser->authentication(config('auth.privileges.userCreate'));
        Log::channel('daily')->info('User_profile_has_accessed_by ->' . $aUser);
        return view('my_profile', ['user' => $aUser, 'pageAuth' => $pageAuth]);
    }

    public function changeMyPass()
    {
        $aUser = Auth::user();
        request()->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        //        Log::channel('daily')->info('User password has validated');
        $aUser->password = Hash::make(request('password'));
        $msg = $aUser->save();

        if ($msg) {
            Log::channel('daily')->info('changeMyPass Done: UserController ->' . $msg . 'User ->' . $aUser);
            //            LogActivity::addToLog('changeMyPass Done: UserController', $aUser);
        } else {
            Log::channel('daily')->info('changeMyPass fail: UserController ->' . $msg . 'User ->' . $aUser);
            //            LogActivity::addToLog('changeMyPass fail: UserController', $aUser);
        }

        if ($msg) {
            //            Log::channel('daily')->info('Success Code send successfully');
            return redirect()
                ->back()
                ->with('success', 'Ok');
        } else {
            //            Log::channel('daily')->debug('Success Code sending unsuccessfully');
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error');
        }
    }

    public function getDeletedUser()
    {
        $user = Auth::user();
        $pageAuth = $user->authentication(config('auth.privileges.userCreate'));
        //        Log::channel('daily')->info('Load deleted user details');
        return User::onlyTrashed()->get();
    }

    public function getMobileUsers()
    {
        //                $user = Auth::user();
        //                $pageAuth = $user->authentication(config('auth.privileges.userCreate'));
        //        Log::channel('daily')->info('Get the mobile users');
        return User::join('rolls', 'users.roll_id', 'rolls.id')->where('rolls.level_id', 3)->select('users.name', 'users.email', 'users.id', 'users.last_name')->get();
    }

    public function activeDeletedUser($id)
    {
        $user = Auth::user();
        $pageAuth = $user->authentication(config('auth.privileges.userCreate'));

        $msg = User::withTrashed()->find($id)->restore();

        if ($msg) {
            Log::channel('daily')->info('Activate_deleted_users_successfull ->' . $user . 'Message ->' . $msg);
            return array('id' => 1, 'mgs' => 'true');
        } else {
            Log::channel('daily')->info('Activate_deleted_users_unsuccessfull ->' . $user . 'Message ->' . $msg);
            return array('id' => 0, 'mgs' => 'false');
        }
    }

    public function authToken(Request $request)
    {
        $req = $request->all();
        $req_string = json_encode($req);
        Log::channel('daily')->info('Auth_Token_Gen_Request ->' . $req_string);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        //        Log::channel('daily')->info('auth token details has validated');
        $user = User::where('email', $request->email)->whereHas('roll.level', function ($query) {
            $query->where('levels.value', '3');
        })->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        Log::channel('daily')->info('Token_has_created_successfully_for_user' . $user);
        return array("token" => $user->createToken($request->device_name)->plainTextToken, 'user' => $user);
    }
}
