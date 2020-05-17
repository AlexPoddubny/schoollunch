<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Repositories\PermissionsRepository;
use App\Repositories\RolesRepository;
use App\Role;
use Illuminate\Http\Request;
use Gate;

class RolesController extends AdminController
{
    
    protected $perm_rep;
    protected $role_rep;
    
    public function __construct(PermissionsRepository $perm_rep, RolesRepository $role_rep)
    {
        parent::__construct();
        $this->perm_rep = $perm_rep;
        $this->role_rep = $role_rep;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('Roles_Edit')){
            abort(403);
        }
        $this->title .= 'Ролі та дозволи';
        $roles = $this->role_rep->getWithRelationCount('users');
        $this->content = view('admin.roles_content')
            ->with(['roles' => $roles])
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('Roles_Edit')){
            abort(403);
        }
        $role = Role::find($id);
        $perms = Permission::all();
        $this->title .= 'Роль - ' . $role->description;
        $this->content = view('admin.role_edit')
            ->with([
                'role' => $role,
                'perms' => $perms
            ])
            ->render();
        return $this->renderOutput();
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
        if (Gate::denies('Roles_Edit')){
            abort(403);
        }
        $result = $this->perm_rep->changePermissions($request, $id);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
    
        return back()->with($result);
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
