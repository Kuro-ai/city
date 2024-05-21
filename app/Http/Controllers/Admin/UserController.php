<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', 0)->paginate(10);
        return view('admin.user.index', ['users' => $users]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        session()->flash('deletestatus', $user->name. '  is successfully deleted!');
        return redirect()->route('admin.user.index'); 
    }
}
