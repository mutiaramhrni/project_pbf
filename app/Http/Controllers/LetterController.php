<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Letters;
use App\Models\User;
use App\Models\PermintaanSurat;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    // Function to display the details of a specific letter
    public function detailLetter($id)
    {
        // Fetch the letter by its ID along with the associated user
        $letter = Letters::with('penerima')->findOrFail($id);
        $userId = auth()->id();
        // Return the view with the letter and user data
        return view('pages.transaction.suratkeluar.detail', compact('letter', 'userId'));
    }


    public function edit($id)
{
    // Fetch the letter by ID from the database
    $surat = Letters::findOrFail($id);

    // Get all users except the authenticated user
    $users = User::where('id', '!=', Auth::id())->get(['id', 'name']);

    // Return the view for editing the letter with user data
    return view('pages.editLetter', compact('surat', 'users'));
}


public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'pengirim' => 'required|string',
        'id_penerima' => 'required|string',
        'nomor_surat' => 'required|string',
        'perihal' => 'required|string',
        'agenda' => 'required|string',
        'tanggal_event' => 'required|date',
        'lampiran' => 'nullable|mimes:pdf,doc,docx', // Update allows lampiran to be nullable
    ]);

    // Get the authenticated user's ID
    $userId = auth()->id();

    // Find the surat by ID
    $surat = Letters::findOrFail($id);

    // Check if the lampiran file is uploaded
    if ($request->hasFile('lampiran')) {
        $file = $request->file('lampiran');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
        $validatedData['lampiran'] = $fileName;

        // Delete the old lampiran file if it exists
        if ($surat->lampiran) {
            $oldFile = public_path('uploads/' . $surat->lampiran);
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
    } else {
        // Keep the old file if no new file is uploaded
        $validatedData['lampiran'] = $surat->lampiran;
    }

    // Update the surat record
    $surat->update($validatedData);

    // Redirect or return a response as needed
    return redirect()->back()->with('success', 'Surat berhasil diupdate');
}

    
    public function deleteLetter($id)
    {
       
        $letter = Letters::find($id);
        $letter->delete();

        return redirect()->route('suratkeluar')->with('success', 'Surat berhasil dihapus');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'pengirim' => 'required|string',
            'id_penerima' => 'required|string',
            'nomor_surat' => 'required|string',
            'perihal' => 'required|string',
            'agenda' => 'required|string',
            'tanggal_event' => 'required|date',
            'lampiran' => 'required|mimes:pdf', // Example file types and size, adjust as needed
        ]);

        // Get the authenticated user's ID
        $userId = auth()->id();

        // Handle file upload
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $validatedData['lampiran'] = $fileName;
        }

        // Add the user ID to the data
        $validatedData['user_id'] = $userId;

        // Create the surat record
        Letters::create($validatedData);

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Surat berhasil dikirim');
    }




    public function archive(Request $request)
{
    $query = Letters::query();
    
    if ($request->filled('date')) {
        $query->whereDate('tanggal_event', $request->input('date'));
    }
    
    if ($request->filled('month')) {
        $query->whereMonth('tanggal_event', $request->input('month'));
    }
    
    if ($request->filled('year')) {
        $query->whereYear('tanggal_event', $request->input('year'));
    }

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('nomor_surat', 'like', "%$search%")
              ->orWhere('pengirim', 'like', "%$search%")
              ->orWhere('perihal', 'like', "%$search%");
        });
    }

    $letters = $query->paginate(15); // Menampilkan 15 item per halaman
    
    return view('pages.archive', compact('letters'))->with('request', $request->all());
}

   


    

}