<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends AdminController
{
    
    protected $user_rep;
    protected $role_rep;
    
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
        $result = $this->role_rep->changeRoles($request);
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
        $user = $this->user_rep->getWhere($id)->first();
        $roles = $this->role_rep->get();
        $this->title .= 'Користувач - ' . fullname($user);
        $this->content = view('admin.user_edit')
            ->with(['user' => $user, 'roles' => $roles])
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
