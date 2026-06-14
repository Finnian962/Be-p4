<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PraktijkmanagementController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }

    public function manageUserroles()
    {
        $users = $this->userModel->sp_GetAllUsers(auth()->user()->id);

        return view('Praktijkmanagement.userroles', [
            'title' => 'Gebruikersrollen',
            'users' => $users,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // View
        return view('Praktijkmanagement.index', [
            'title' => 'Praktijkmanagement Home',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $user = $this->userModel->sp_GetUserById($id);

        $userroles = $this->userModel->sp_GetAllUserroles();

        return view('Praktijkmanagement.edit', [
            'title' => 'Wijzig de gebruikersrol',
            'user' => $user,
            'userroles' => $userroles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'max:255'],
            'rolename' => ['required', 'string'],
        ]);

        $affected = $this->userModel->sp_UpdateUser(
            $id,
            $validated['name'],
            $validated['email'],
            $validated['rolename']
        );

        if ($affected === 0) {
            return back()->with('error', 'Er is niets gewijzigd of error bestaat niet');
        }

        return redirect()->route('praktijkmanagement.userroles')
            ->with('success', 'User succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userId)
    {
        $result = $this->userModel->sp_DeleteUser($userId);

        if ($result > 0) {
            return redirect()->route('praktijkmanagement.userroles')
                ->with('success', 'User is succesvol verwijderd');
        }

        return redirect()->route('praktijkmanagement.userroles')
            ->with('error', 'User is niet verwijderd');
    }
}
