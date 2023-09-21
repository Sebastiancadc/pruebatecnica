<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDAO;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends HomeController
{
    private $userDAO;

    public function __construct(UserDAO $userDAO)
    {
        $this->userDAO = $userDAO;
    }

    public function index()
    {
        $users = $this->userDAO->usersAll();
        
        if (auth()->user()->role === 'Usuario') {
            $user = $users->getData();
            return view('users.indexuser', compact('user'));
        } else {
            $users = $users->getData();
            return view('users.index', compact('users'));
        }
    }

    public function create(Request $request)
    {
        $this->userDAO->store($request);
        Alert::success('¡Éxito!', 'Usuario creado correctamente.');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $this->userDAO->update($request, $id);
        Alert::success('¡Éxito!', 'Usuario actualizado correctamente');
        return redirect()->back();
    }

    public function delete($id)
    {
        $this->userDAO->destroy($id);
        Alert::success('¡Éxito!', 'Usuario eliminado correctamente');
        return redirect()->back();
    }
}
