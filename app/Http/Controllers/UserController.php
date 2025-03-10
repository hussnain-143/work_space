<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    /**
     * Login User
     */
    public function login(Request $request)
    {
        // Validate user input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            
            return redirect()->route('workspace.dashboard');
        }
    
        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('templates.addUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
            'phone' => 'digits:11|numeric',
            'role' => 'required|in:super_admin,manager,employee',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);
    
        return redirect()->route('user.form')->with('success','New User Added Successfully');
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
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('templates.updateUser', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id); // Use findOrFail() to throw 404 if not found
        // dd($request->all());
    
        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:5|confirmed', // Nullable means not required
            'phone' => 'required|digits:11|numeric',
        ]);
    
        // ✅ Handle Image Upload (only if a new image is uploaded)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $id . '.png';
            $image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }
    
        // ✅ Update User Data
        $user->name = $request->name;
        $user->email = $request->email;
    
        // ✅ Update Password (only if provided & hashed)
        if (!empty($request->password)) {
            $user->password = $request->password;
        }
    
        $user->phone = $request->phone;
        $user->role = $request->role ?? $user->role; 
        
        $user->save();


    
        // ✅ Redirect back with success message
        return redirect()->route('user.edit', $user->id)->with('success', 'User updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Ensure the user is authenticated and is a super admin
    if (Auth::check() && Auth::user()->role === 'super_admin') {
        
        // Find the user by ID
        $user = User::find($id);

        // Check if user exists
        if (!$user) {
            return redirect()->back();
        }

        // Delete the user
        $user->delete();

        // Redirect back with success message
        return redirect()->route('workspace.users');
    }

    // Redirect unauthorized users
    return redirect()->route('login');
}

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()-> route('login');
    }
}