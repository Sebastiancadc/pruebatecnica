<?php

namespace App;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserDAO
{
    /**
     * Muestra el panel de inicio de la aplicación.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Obtiene todos los usuarios o un usuario específico según el rol del usuario autenticado.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function usersAll()
    {
        if (auth()->user()->role == 'Usuario') {
            $users = User::findOrFail(auth()->user()->id);
        } else {
            $users = User::all();
        }
        return response()->json($users);
    }

    /**
     * Crea un nuevo usuario a partir de los datos proporcionados en la solicitud.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
            DB::commit();
            return response()->json($user);
        } catch (Exception $e) {
            DB::rollback();
            Alert::error('Error', $e);
            return redirect()->back();
        }
    }

    /**
     * Actualiza un usuario existente con los datos proporcionados en la solicitud.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if (!isset($request->role)) {
                $user->role = 'Usuario';
            }
            
            if (isset($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            DB::commit();
            return response()->json($user);
        } catch (Exception $e) {
            DB::rollback();
            Alert::error('Error', $e);
            return redirect()->back();
        }
    }

    /**
     * Elimina un usuario por su ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->delete();
            DB::commit();
            return response()->json($user);
        } catch (\Throwable $e) {
            DB::rollback();
            Alert::error('Error', $e);
            return redirect()->back();
        }
    }
}
