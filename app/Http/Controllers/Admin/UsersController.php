<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Gate;

class UsersController extends AdminController
{
    
    protected $user_rep;
    protected $role_rep;
    protected $rules = [
        'phone' => ['required', 'digits:10'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'firstname' => ['required', 'string', 'min:4', 'max:100'],
        'middlename' => ['required', 'string', 'max:100'],
        'lastname' => ['required', 'string', 'max:100'],
        'sex' => ['required'],
    ];
    
    public function __construct(UsersRepository $user_rep, RolesRepository $role_rep)
    {
        parent::__construct();
        $this->user_rep = $user_rep;
        $this->role_rep = $role_rep;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index()
    {
        if (Gate::denies('View_Admin')){
            abort(403);
        }
        $this->title .= 'Користувачі';
        $users = $this->user_rep->getPaginated(5);
        $this->content = view('admin.users_content')
            ->with(['users' => $users])
            ->render();
        return $this->renderOutput();
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // перенести у update
        if (Gate::denies('User_Register')){
            abort(403);
        }
        $this->validate($request, $this->rules);
        $result = $this->user_rep->saveUser($request);
//        $result = $this->role_rep->changeRoles($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return back()->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user){
            abort(404);
        }
        $this->title .= 'Користувач - ' . fullname($user);
        $this->content = view('admin.user_edit')
            ->with([
                'user' => $user,
                'roles' => Role::all()
            ])
            ->render();
        return $this->renderOutput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
