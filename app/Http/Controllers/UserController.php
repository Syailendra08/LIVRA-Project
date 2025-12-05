<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email:dns',
        'password' => 'required|min:8',

    ], [
        'name.required' => 'Name is required.',
        'name.min' => 'Name must be at least 3 characters.',
        'email.required' => 'Email is required.',
        'email.email' => 'Email must be a valid address.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
    ]
);

    $createUser = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'staff', 
    ]);
   if ($createUser) {
    return redirect()->route('admin.users.index')->with('success', 'Success, user has been added!');
} else {
    return redirect()->route('admin.users.index')->with('error', 'Failed, user failed to added!');
}
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
            'password' => 'required|min:8',

        ], [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 3 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid address.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
        ]
        );

        $updateUser = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff'
        ]);
        if ($updateUser) {
            return redirect()->route('admin.users.index')->with('success', 'Success, Staff has been updated!');
        } else {
            return redirect()->route('admin.users.index')->with('error', 'Failed, to update the staff!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         {
        $deleteData = User::where('id', $id)->delete();
        if($deleteData) {
            return redirect()->route('admin.users.index')->with('success', 'Success the user data has been deleted!');
        }else {
            return redirect()->back()->with('error', 'Failed to deleted the data!');
        }
    }
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
        ], [
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least 3 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least 3 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid address.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',

        ]);

    $createData = User::create([
        'name' => $request->first_name . ' ' . $request->last_name,
        'email' => $request->email,
        'password' =>hash::make($request->password),
        'role' => 'user'
    ]);

    if ($createData) {
        return redirect()->route('login')->with('success', 'Registration successful. Please log in!');
    }else {
        return redirect()->route('signup')->with('Failed', 'Registration failed. Please try again.');
    }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email.',
            'password.required' => 'Password is required.',


        ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin.dashboard')->with('success', 'Login successful. Welcome Admin!');
                } elseif (Auth::user()->role === 'staff') {
                    return redirect()->route('staff.dashboard')->with('success', 'Login successful. Welcome Staff!');
                } else {
                    return redirect()->route('gallery')->with('success', 'Login successful. Welcome back!');
                }
        } else {
                return redirect()->route('login')->with('failed', 'Login failed. Please check your credentials and try again.');
            }
        }



}
