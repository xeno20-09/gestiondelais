<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //    protected $redirectTo = 'recours/home/default';
    protected function redirectTo()
    {
        $user = Auth::user();
        /* /home/president
/home/conseiller
/home/greffier */
        return match ($user->role) {
            'PCA' => 'recours/home/president',
            'PCJ' => 'recours/home/president',
            'AUDITEUR'               => 'recours/home/auditeur',
            'CONSEILLER'             => 'recours/home/conseiller',
            'GREFFIER'               => 'recours/home/greffier',
            'SECRETAIRE'             => 'recours/home/secretaire',
            'SUPER ADMIN'            => 'recours/home/admin',
            default                  => 'recours/home/default',
        };
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
