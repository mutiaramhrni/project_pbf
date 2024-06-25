<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    

    public function showMU()
    {
        $currentUserId = Auth::id();

        $users = User::where('id', '!=', $currentUserId)->get();

        return view('admin.showMU', compact('users'));
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            if (request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
            }

            return redirect()->route('showMU')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Error deleting User.']);
            }

            return redirect()->back()->with('error', 'Error deleting User.');
        }
    }
}
