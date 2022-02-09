<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            return redirect()->route('/admin/dashboard');
        }

        Session::flash('error-msg', 'Invalid Credentials');
        return redirect()->back();
    }
}
