<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

class PagesController extends Controller
{
  public function index()
  {
      return view('pages.beranda');
  }
  public function suratmasuk()
  {
      return view('pages.suratmasuk');
  }
  public function createincoming()
  {
      return view('pages.transaction.suratmasuk.create');
  }
  public function suratkeluar()
  {
      return view('pages.suratkeluar');
  }
  public function profil(Request $request): View
  {
      return view('pages.profil', [
          'user' => $request->user(),
      ]);
  }
}