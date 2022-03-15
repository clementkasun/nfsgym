<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Privilege;
use App\Models\Roll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Helpers\LogActivity;

class RollController extends Controller {

    public function index() {
        $rolls = Roll::get();
        $level = Level::get();
        $privileges = Privilege::get();
        $user = Auth::user();
        $pageAuth = $user->authentication(config('auth.privileges.userCreate'));
//        Log::channel('daily')->info('All rolls, privilleges,levels and pageauth');
        return view('rolls', ['privileges' => $privileges, 'levels' => $level, 'pageAuth' => $pageAuth]);
    }

    public function __construct() {
//        $this->middleware(['auth']);
    }

    public function create() {
        request()->validate([
            'roll' => ['required', 'string'],
            'level' => ['required', 'numeric'],
        ]);
        $roll = new Roll();
        $roll->name = request('roll');
        $roll->level_id = request('level');
        $msg = $roll->save();
        if ($msg) {
//            LogActivity::addToLog('roll added', $roll);
            Log::channel('daily')->info('Rolls_add_successfull ->' . $roll . 'Message' . $msg);
            return redirect()
                            ->back()
                            ->with('success', 'Ok');
        } else {
            Log::channel('daily')->info('Rolls_add_unsuccessfull ->' . $roll . 'Message' . $msg);
            return redirect()
                            ->back()
                            ->withInput()
                            ->with('error', 'Error');
        }
    }

    public function store($id) {
        request()->validate([
            'roll' => ['required', 'string'],
        ]);
//        Log::channel('daily')->info('Roll has validated successfully');
        $roll = Roll::findOrFail($id);
        $roll->name = request('roll');
        $msg = $roll->save();

        if ($msg) {
//            LogActivity::addToLog('roll updated', $roll);
            Log::channel('daily')->info('Roll_details_update_successfull -> Message ->' . $msg . 'Roll ->' . $roll);
            return array('id' => 1, 'message' => 'true');
        } else {
            Log::channel('daily')->info('Roll_details_update_unsuccessfull -> Message ->' . $msg . 'Roll ->' . $roll);
            return array('id' => 0, 'message' => 'false');
        }
    }

    public function getRollPrevilagesById($id) {
        $roll = Roll::findOrFail($id);
//        Log::channel('daily')->info('Load privilleges by id successfully');
        return $roll->privileges;
    }

    public function PrevilagesAdd() {
        \DB::transaction(function () {
            // dd(request('pre'));
            $roll = ROll::findOrFail(request('roll_id'));
            $roll->privileges()->detach();
            $status = true;
            foreach (request('pre') as $value) {

                $roll->privileges()->attach(
                        $value['id'],
                        [
                            'is_read' => $value['is_read'],
                            'is_create' => $value['is_create'],
                            'is_update' => $value['is_update'],
                            'is_delete' => $value['is_delete'],
                        ]
                );
            }
        });
        $id = request('roll_id');
        Log::channel('daily')->info('Privilleges_has_added_to_user_id ->' . $id);
        return array('id' => '1', 'msg' => 'true');
    }

    public function destroy($id) {
        try {

            $roll = ROll::findOrFail($id);
            $msg = $roll->delete();

            if ($msg) {
//                LogActivity::addToLog('roll deleted', $roll);
                Log::channel('daily')->info('roll_deleted_from_roll_id ->' . $id);
                return array('id' => 1, 'message' => 'true');
            } else {
//                LogActivity::addToLog('Fail to delete roll', $roll);
            }
        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->errorInfo[0] == 23000) {
                Log::channel('daily')->info('Cannot_delete_foreign_key_constraint_fails');
                return response(array('id' => 3, 'mgs' => 'Cannot delete foreign key constraint fails'), 200)
                                ->header('Content-Type', 'application/json');
            } else {
                Log::channel('daily')->info('Internal_Server_Error');
                return response(array('id' => 3, 'mgs' => 'Internal Server Error'), 500)
                                ->header('Content-Type', 'application/json');
            }
        }
    }

}
