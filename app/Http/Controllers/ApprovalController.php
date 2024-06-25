<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Letters;
use App\Models\Approval;
use App\Models\User;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

class ApprovalController extends Controller
{
    public function approvals()
    {
        $user = Auth::user();
        $letters = Letters::with(['penerima', 'approvals'])->where('id_penerima', $user->id)->get();
    
        return view('pages.approvals', compact('letters'));
    }

    public function approve(Request $request, $letter_id)
    {
        $user = Auth::user();
        $letter = Letters::where('id', $letter_id)->where('id_penerima', $user->id)->first();

        if ($letter) {
            if ($request->hasFile('lampiran')) {
                // Delete the old lampiran if exists
                if ($letter->lampiran) {
                    Storage::delete('uploads/' . $letter->lampiran);
                }

                // Store the new lampiran with a human-readable name
                $file = $request->file('lampiran');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $letter->lampiran = $fileName;
                $letter->save();
            }

            $approval = Approval::where('letter_id', $letter_id)
                                ->where('user_id', $user->id)
                                ->first();

            if ($approval) {
                $approval->status = true;
                $approval->save();
            } else {
                Approval::create([
                    'letter_id' => $letter_id,
                    'user_id' => $user->id,
                    'status' => true
                ]);
            }

            return redirect()->route('approvals')->with('success', 'Surat disetujui');
        } else {
            return redirect()->route('approvals')->with('error', 'Anda tidak memiliki akses untuk menyetujui surat ini');
        }
    }

    public function reject($letter_id)
    {
        $user = Auth::user();
        $letter = Letters::where('id', $letter_id)->where('id_penerima', $user->id)->first();

        if ($letter) {
            $approval = Approval::where('letter_id', $letter_id)
                                ->where('user_id', $user->id)
                                ->first();

            if ($approval) {
                $approval->status = false;
                $approval->save();
            } else {
                Approval::create([
                    'letter_id' => $letter_id,
                    'user_id' => $user->id,
                    'status' => false
                ]);
            }

            return redirect()->route('approvals')->with('success', 'Surat ditolak');
        } else {
            return redirect()->route('approvals')->with('error', 'Anda tidak memiliki akses untuk menolak surat ini');
        }
    }
}