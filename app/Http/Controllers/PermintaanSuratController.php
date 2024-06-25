<?php
namespace App\Http\Controllers;

use App\Models\PermintaanSurat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanSuratController extends Controller
{

    public function permintaansurat()
    {
          return view('pages.permintaansurat');
    }

    public function daftarrequest()
    {
        // Get the currently logged-in user's ID
        $currentUserId = Auth::id();

        // Fetch users with role 'sekum'
        $sekumUsers = User::where('role', 'sekum')->pluck('id')->toArray();

        // Fetch PermintaanSurat where 'send_to' is a sekum user and created by the currently logged-in user
        $letters = PermintaanSurat::where('user_id', $currentUserId)
                                  ->whereIn('send_to', $sekumUsers)
                                  ->with('user')
                                  ->get();

        // Fetch the names of the sekum users
        foreach ($letters as $letter) {
            $letter->send_to_name = User::find($letter->send_to)->name;
        }

        return view('pages.daftarrequest', compact('letters'));
    }



    public function permintaansekdept()
    {
        // Get the currently logged-in user
        $currentUser = Auth::user();
    
        // Check if the currently logged-in user's role is 'sekum'
        if ($currentUser->role === 'sekum') {
            // Fetch PermintaanSurat where 'send_to' is the currently logged-in user
            $letters = PermintaanSurat::where('send_to', $currentUser->id)
                                      ->with('user')
                                      ->get();
    
            // Add the name of the sender (user) to each letter
            foreach ($letters as $letter) {
                $letter->send_to_name = $currentUser->name;
            }
    
            return view('pages.permintaansekdept', compact('letters'));
        } else {
            // If the logged-in user is not a sekum, return an empty collection or handle as needed
            $letters = collect();
            return view('pages.permintaansekdept', compact('letters'))->with('error', 'You do not have the appropriate role to view these requests.');
        }
    }
    


    
    public function store(Request $request)
    {

      $currentUserId = Auth::id();
        $request->validate([
            'penerima' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'agenda' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'tempat' => 'required|string|max:255',
        ]);

        // Find the user with the role 'sekum'
        $sekum = User::where('role', 'sekum')->first();

        // Create the new permintaan surat
        PermintaanSurat::create([
            'penerima' => $request->penerima,
            'perihal' => $request->perihal,
            'agenda' => $request->agenda,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'send_to' => $sekum->id,
            'user_id' => $currentUserId,
        ]);

        return redirect()->back()->with('success', 'Permintaan surat berhasil dibuat.');
    }



    public function deleteLetterPermintaan($id)
    {
        try {
            // Find the PermintaanSurat by its ID
            $letter = PermintaanSurat::findOrFail($id);

            // Perform the deletion
            $letter->delete();

            // Check if the request is AJAX
            if (request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'Letter deleted successfully.']);
            }

            return redirect()->route('permintaansekdept')->with('success', 'Letter deleted successfully.');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Error deleting letter.']);
            }

            return redirect()->back()->with('error', 'Error deleting letter.');
        }
    }

}