<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDAO;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends HomeController
{
    function index()
    {
        $userDAO = new UserDAO();
        $users = $userDAO->usersAll();
        if (auth()->user()->role == 'Usuario') {
            $user = $users->getData();
            return view('users.indexuser', compact('user'));
        } else {
            $users = $users->getData();
            return view('users.index', compact('users'));
        }
    }

    function create(Request $request)
    {
        $userDAO = new UserDAO();
        $users = $userDAO->store($request);
        Alert::success('¡Éxito!', 'Usuario creado correctamente.');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $userDAO = new UserDAO();
        $users = $userDAO->update($request, $id);
        Alert::success('¡Éxito!', 'Usuario actualizado correctamente');
        return redirect()->back();
    }

    function delete($id)
    {
        $userDAO = new UserDAO();
        $users = $userDAO->destroy($id);
        Alert::success('¡Exito!', 'Usuario ' . $users->name . ' eliminado correctamente');
        return redirect()->back();
    }
}
