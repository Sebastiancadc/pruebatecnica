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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * The function retrieves all users from the database and returns a view with the users data.
     * 
     * @return a view called 'users.index' and passing the 'users' variable to the view.
     */
    public function usersAll()
    {
        if (auth()->user()->role == 'Usuario') {
            $users = User::findOrFail(auth()->user()->id);
        } else {
            $users = User::All();
        }
        return response()->json($users);
    }

    /**
     * The above function creates a new user in the database with the provided name, email, password, and
     * client ID, and then redirects to the user index page.
     * 
     * @param Request request The  parameter is an instance of the Request class, which represents
     * an HTTP request made to the application. It contains all the data sent with the request, such as
     * form inputs, query parameters, and uploaded files.
     * 
     * @return a redirect to the 'user.index' route.
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
     * The above function updates a user's information in a PHP application, including their name, email,
     * password, and client ID, and assigns them a new role if specified.
     * 
     * @param Request request The  parameter is an instance of the Request class, which contains
     * all the data that was sent with the HTTP request. It is used to retrieve the values of the form
     * fields that were submitted.
     * @param id The  parameter is the unique identifier of the user that needs to be updated. It is
     * used to find the user record in the database and update its information.
     * 
     * @return a redirect to the 'user.index' route.
     */
    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if (isset($request->role)) {
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
     * The function destroys a user record in the database and redirects to the user index page,
     * displaying a success message.
     * 
     * @param id The id parameter represents the unique identifier of the user that needs to be deleted.
     * 
     * @return a redirect to the 'user.index' route.
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
