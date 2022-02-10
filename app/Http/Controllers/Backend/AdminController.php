<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;

class AdminController extends Controller
{
    public function adminLoginForm()
    {
        return view('backend.admin.admin_login');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/admin/dashboard');
        }

        Session::flash('error-msg', 'Invalid Credentials');
        return redirect()->back();
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect('login/admin');
    }
}
