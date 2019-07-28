<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()){

            $data = User::latest()->get();
            return DataTables::of($data) ->addColumn('action', function ($user) {
                $edit_button = '<a rel="tooltip" class="btn btn-success btn-link btn-fab" data-original-title="" title=""> '
                                .' <i class="material-icons">edit</i>'
                                .' <div class="ripple-container"></div> '
                                .' </a> ';
                $delete_buttion = '<button type="button" class="btn btn-danger btn-link btn-fab" data-original-title="" title="">'
                                . '<i class="material-icons">close</i>'
                                . '<div class="ripple-container"></div>'
                                .' </button> ';
            

                //if (Auth::user()->id != $user->id)
                    return $edit_button . $delete_buttion;
               // return $edit_button;
            })
            ->removeColumn('password')->make(true);
            
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
}
