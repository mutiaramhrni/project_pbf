<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Letters;
use App\Models\Attachment;
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
  public function pengirimansurat()
  {
      return view('pages.pengirimansurat');
  }
  public function permintaansurat()
  {
      return view('pages.permintaansurat');
  }
  public function store(Request $request)
  {
      // Validasi data yang diterima dari form
      $request->validate([
          'pengirim' => 'required|string|max:255',
          'nomor_agenda' => 'required|string|max:255',
          'tanggal_event' => 'required|date',
          'perihal' => 'required|string|max:255',
          'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
      ]);
      $user = Auth::user();
      // Simpan surat ke dalam database
      $letter = Letters::create([
          'pengirim' => $request->input('pengirim'),
          'nomor_agenda' => $request->input('nomor_agenda'),
          'tanggal_event' => $request->input('tanggal_event'),
          'perihal' => $request->input('perihal'),
          'user_id' => $user->id,
      ]);

      // Simpan lampiran ke dalam database
      
      if ($request->hasFile('filename')) {
          foreach ($request->filename as $attachment) {
              $extension = $attachment->getClientOriginalExtension();
              if (!in_array($extension, ['png', 'jpg', 'jpeg', 'pdf'])) continue;
              $filename = time() . '-' . $attachment->getClientOriginalName();
              $filename = str_replace(' ', '-', $filename);
              $attachment->storeAs('public/filename', $filename);
              Attachment::create([
                  'filename' => $filename,
                  'extension' => $extension,
                  'user_id' => $user->id,
                  'letter_id' => $letter->id,
              ]);
          }
      }

      // Kembali dengan pesan sukses
      return back()->with('success', 'Surat dan lampiran berhasil disimpan!');
  }
  public function suratmasuk()
  {
      return view('pages.suratmasuk');
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