<?php

namespace App\Http\Controllers;

use App\Models\Privilege;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PrivilegeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        Log::channel('daily')->info('User has authenticated');
    }

    public function store(Request $request)
    {
        $req = $request->all();
        $req_string = json_encode($req);
        Log::channel('daily')->info('Privillege Request Recieved for save ->' . $req_string);
        $privillege_save = new Privilege;
        $privillege_save->name = $request->name;
        $privillege_save->save();
        if ($privillege_save == true) {
            Log::channel('daily')->info('Privillege has added ->' . $privillege_save);
            return array('status' => 1, 'msg' => 'Privillage Addition is Successfull!');
        } else {
            Log::channel('daily')->info('Privillege Addition is Unsuccessfull ->' . $privillege_save);
            return array('status' => 0, 'msg' => 'Privillage Addition is Unsuccessfull!');
        }
    }

    public function show()
    {
        $privillege_all = Privilege::all();
        return $privillege_all;
    }

    public function edit($id)
    {
        $privillege_edit = Privilege::find($id);
        return $privillege_edit;
    }

    public function update(Request $request, $id)
    {
        $req = $request->all();
        $req_string = json_encode($req);
        Log::channel('daily')->info('Privillege Request Recieved for update ->' . $req_string);

        $privillege_update = Privilege::find($id);
        $privillege_update->name = $request->name;
        $privillege_update->save();
        if ($privillege_update == true) {
            Log::channel('daily')->info('Privillege has updated ->' . $privillege_update);
            return array('status' => 1, 'msg' => 'Privillage Update is Successfull!');
        } else {
            Log::channel('daily')->info('Privillege Updation is Unsuccessfull ->' . $privillege_update);
            return array('status' => 0, 'msg' => 'Privillage Update is Unsuccessfull!');
        }
    }

    public function delete($id)
    {
        $privillege_delete = Privilege::find($id)->delete();

        if ($privillege_delete == true) {
            Log::channel('daily')->info('Privillege has deleted ->' . $privillege_delete);
            return array('status' => 1, 'msg' => 'Privillage Delete is Successfull!');
        } else {
            Log::channel('daily')->info('Privillege deletion failed ->' . $privillege_delete);
            return array('status' => 0, 'msg' => 'Privillage Delete is Unsuccessfull!');
        }
    }
}
