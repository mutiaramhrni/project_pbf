<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Letters;
use App\Models\User;
use App\Models\User;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

class PagesController extends Controller
{
  public function index()
{
    $userId = Auth::id();
    $suratMasuk = Letters::where('id_penerima', $userId)->count();
    $suratKeluar = Letters::where('user_id', $userId)->count();
    $userAktif = User::count(); 

    return view('pages.beranda', compact('suratMasuk', 'suratKeluar', 'userAktif'));
}


{
    $userId = Auth::id();
    $suratMasuk = Letters::where('id_penerima', $userId)->count();
    $suratKeluar = Letters::where('user_id', $userId)->count();
    $userAktif = User::count(); 

    return view('pages.beranda', compact('suratMasuk', 'suratKeluar', 'userAktif'));
}


  public function pengirimansurat()
{
    $userId = auth()->id();
    $user = User::find($userId); 

    if ($user) {
        $name = $user->name; 
        $users = User::select('id', 'name')->get(); // Mengambil semua data user dengan kolom 'id' dan 'name'
        
        return view('pages.pengirimansurat', [
            'name' => $name,
            'users' => $users,
        ]);
    } else {
        return redirect()->route('login')->with('error', 'User not found');
    }
}



  
  
{
    $userId = auth()->id();
    $user = User::find($userId); 

    if ($user) {
        $name = $user->name; 
        $users = User::select('id', 'name')->get(); // Mengambil semua data user dengan kolom 'id' dan 'name'
        
        return view('pages.pengirimansurat', [
            'name' => $name,
            'users' => $users,
        ]);
    } else {
        return redirect()->route('login')->with('error', 'User not found');
    }
}



  
  
  public function suratmasuk()
{
    $id_penerima = auth()->user()->id; // Assuming 'id_penerima' is the authenticated user's ID
    $letters = Letters::where('id_penerima', $id_penerima)->get();

    return view('pages.suratmasuk', compact('letters'));
}


public function suratkeluar()
{
    $user_id = auth()->user()->id;
    $letters = Letters::with('penerima')->where('user_id', $user_id)->get();

    return view('pages.suratkeluar', compact('letters'));
}



{
    $id_penerima = auth()->user()->id; // Assuming 'id_penerima' is the authenticated user's ID
    $letters = Letters::where('id_penerima', $id_penerima)->get();

    return view('pages.suratmasuk', compact('letters'));
}


public function suratkeluar()
{
    $user_id = auth()->user()->id;
    $letters = Letters::with('penerima')->where('user_id', $user_id)->get();

    return view('pages.suratkeluar', compact('letters'));
}



  public function profil(Request $request): View
  {
      return view('pages.profil', [
          'user' => $request->user(),
      ]);
  }

  
  public function statussurat()
{
    $user = Auth::user();
        $letters = Letters::with(['penerima', 'approvals'])
                    ->where('user_id', $user->id)
                    ->get();

        return view('pages.statussurat', compact('letters'));
}


  
  
}