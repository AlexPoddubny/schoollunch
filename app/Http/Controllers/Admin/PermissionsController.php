<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PermissionsRepository;
use App\Repositories\RolesRepository;
use Illuminate\Http\Request;


class PermissionsController extends AdminController
{
    
    protected $perm_rep;
    protected $role_rep;
    
    public function __construct(PermissionsRepository $perm_rep, RolesRepository $role_rep)
    {
        parent::__construct();
        $this->perm_rep = $perm_rep;
        $this->role_rep = $role_rep;
        $this->template = 'admin.permissions';
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title .= 'Ролі та дозволи';
        $roles = $this->role_rep->getWithRelationCount('permissions');
        $perms = $this->perm_rep->getAll();
        $this->content = view('admin.permissions_content')
            ->with(['roles' => $roles, 'perms' => $perms])
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
        
        $result = $this->perm_rep->changePermissions($request);
        
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
