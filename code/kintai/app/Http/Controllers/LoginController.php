<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Syain;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function username()
    {
        return 'syain_number';
    }

    public function login(Request $request)
    {
        $syain_number = $request->input('syain_number');

        $user = Syain::where('syain_number', $syain_number)->first();

        if ($user) {
            Auth::login($user);
            return $this->authenticated($request, $user);
        } else {
            return back()->withErrors([
                'syain_number' => '社員番号が存在しません。',
            ]);
        }
    }

    public function logout(Request $request)
        {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login');
        }

        protected function authenticated(Request $request, $user)
        {
            switch ($user->user_type) {
                case '社員':
                    return $this->show($user->syain_number, 'syain');
                case '社員管理者':
                    return $this->show($user->syain_number, 'kanrisya');
                case '労務士':
                    return $this->show($user->syain_number, 'roumusi');
                default:
                    return redirect('/login');
            }
        }

        public function show($syain_number, $view)
       {
           $syain = Syain::where('syain_number', $syain_number)->first();

          if ($syain) {
            session(['user' => $syain]);
        return redirect("/$view/$syain_number");
          } else {
        return redirect('/login')->with('error', '社員が存在しません。');
         }
       }





}
