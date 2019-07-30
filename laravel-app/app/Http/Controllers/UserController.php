<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use App\Http\Requests\UserRequest;
use App\Http\Requests\CreateUsersRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
            $current_user = Auth::user();
            return DataTables::of($data) ->addColumn('action', function ($user) use ($current_user) {
                $edit_button = '<a rel="tooltip" class="btn btn-success btn-link btn-fab btn-edit" href="'. route('user.edit', $user->id) .'" data-original-title="" title=""> '
                                .' <i class="material-icons">edit</i>'
                                .' <div class="ripple-container"></div> '
                                .' </a> ';
                $profile_button = '<a id="abcdf" rel="tooltip" class="btn btn-success btn-link btn-fab btn-profile" data-original-title="" title=""> '
                                .' <i class="material-icons">person</i>'
                                .' <div class="ripple-container"></div> '
                                .' </a> ';
                $delete_buttion = '<button type="button" class="btn btn-danger btn-link btn-fab btn-delete" href="'. route('user.destroy', $user->id) .'" data-original-title="" title="">'
                                . '<i class="material-icons">close</i>'
                                . '<div class="ripple-container"></div>'
                                .' </button> ';
            
                if ($current_user->id != $user->id)
                    return $edit_button . $delete_buttion;
                return $profile_button;

            })->addColumn('group', function ($user)  {

                return $user->group->text;

            })->removeColumn('password')->make(true);
            
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
        $groups = Group::All();
        return view('users.create', compact('groups'));
    }

    /**
     * Show the form for creating multiple new users
     *
     * @return \Illuminate\View\View
     */
    public function createMulti()
    {
        $groups = Group::All();
        return view('users.multiple_create', compact('groups'));
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
        $group = Group::where('id', $request->get('group_id'))->first();
        $model->group()->associate($group);
        $model->fill($request->merge(['password' => Hash::make($request->get('password'))])->all());
        $model->save();

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Store some newly created users in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMulti(CreateUsersRequest $request)
    {
        $group = Group::where('id', $request->get('group_id'))->first();
        
        foreach($request->get('emails') as $email){
            $user = new User();
            $user->group()->associate($group);
            $user->email= $email;
            $user->name= explode('@',$email)[0];
            $user->fill($request->merge(['password' => Hash::make($request->get('password'))])->all());
            $user->save();
        }

        return redirect()->route('user.index')->withStatus(__('User(s) successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $groups = Group::All();
        return view('users.edit', compact('user', 'groups'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $password = $request->get('password');
        
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));

        $group = Group::where('id', $request->get('group_id'))->first();
        
        if ($group->id != $user->group->id){
            $user->group()->associate($group);
            $user->save();
        }
        
        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $user_id)
    {
        if ($request->ajax()) {
            if (User::where('id', $user_id)->first()->delete())
                return response('OK', 200);
            else response('Not OK', 200);
        }
        return response(404);
            
    }
}
