<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{

    public function index()
    {

        $registeredAdmins = DB::table('admins')->where('password', '!=', null)->count();
        if ($registeredAdmins == 0) {
            $admin = DB::table('admins')->get();
            if (sizeof($admin) == 0) {
                $token = Uuid::uuid4()->toString();
                $admin = Admin::create([
                    'invite_token' =>  $token
                ]);
                $all_roles_in_database = Role::all()->count();
                if ($all_roles_in_database == 0 ) {
                    Role::create(['guard_name' => 'admin', 'name' => 'root']);
                }
                $admin->syncRoles(['root']);
            } else {
                $token = $admin[0]->invite_token;
            }
            // dd(1);
            return redirect()->route('admin.register.index', ['t' => $token]);
        } else {
            dd(2);
            // return Inertia::render('Admin/Auth/Login',
            // [
            //     'canResetPassword' => Route::has('password.request'),
            //     'status' => session('status'),
            // ]);
        }

    }


    public function postProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            if ($request->session()->has('url.intended')) {
                return redirect()->intended($request->session()->get('url.intended'));
            }
            return redirect()->route('admin.dashboard.index');
        }

        return back()->withErrors([
            'email' => 'E-mail e/ou senha inválidos.',
        ])->onlyInput('email');
    }
}
