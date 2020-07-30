<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function ref(Request $request)
    {
        # здесь запрос /?ref={login}
        $login = $request->query('ref');

        # если есть запрос ?ref
        if ( $login )
        {
            $user = User::where('login', $login)->first();

            # если нет в базе, редиректим на home
            if ( ! $user ) return redirect()->route('home');
            # если авторизован, редиректим на home
            if ( Auth::user()
              && Auth::user()->id === $user->id )
            {
                return redirect()->route('home');
            }

            $user->count++;
            $user->save();
    
            return redirect()->route('home');
        }

        # показать страницу приветствия
        return view('welcome');
    }
}
