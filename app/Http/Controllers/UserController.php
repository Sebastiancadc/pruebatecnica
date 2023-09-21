<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDAO;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends HomeController
{
    /**
     * Muestra una lista de usuarios según el rol del usuario autenticado.
     *
     * @return \Illuminate\View\View
     */
    function index()
    {
        $userDAO = new UserDAO();
        $users = $userDAO->usersAll();

        // Verifica el rol del usuario autenticado para determinar la vista apropiada.
        if (auth()->user()->role == 'Usuario') {
            $user = $users->getData();
            return view('users.indexuser', compact('user'));
        } else {
            $users->getData();
            return view('users.index', compact('users'));
        }
    }

    /**
     * Crea un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function create(Request $request)
    {
        $userDAO = new UserDAO();
        $userDAO->store($request);
        // Muestra una alerta de éxito y redirige de regreso.
        Alert::success('¡Éxito!', 'Usuario creado correctamente.');
        return redirect()->back();
    }

    /**
     * Actualiza un usuario existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $userDAO = new UserDAO();
        $userDAO->update($request, $id);

        // Muestra una alerta de éxito y redirige de regreso.
        Alert::success('¡Éxito!', 'Usuario actualizado correctamente');
        return redirect()->back();
    }

    /**
     * Elimina un usuario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function delete($id)
    {
        $userDAO = new UserDAO();
        $userDAO->destroy($id);
        // Muestra una alerta de éxito y redirige de regreso.
        Alert::success('¡Exito!', 'Usuario eliminado correctamente');
        return redirect()->back();
    }
}
