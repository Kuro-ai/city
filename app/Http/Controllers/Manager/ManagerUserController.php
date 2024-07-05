<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ManagerUserController extends Controller
{
    public function index()
    {
        $users = User::where('userRole', '!=', 'manager')->paginate(10);
        return view('manager.user.index', ['users' => $users]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        session()->flash('deletestatus', $user->name. '  is successfully deleted!');
        return redirect()->route('manager.user.index'); 
    }
}
