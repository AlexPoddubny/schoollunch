<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Gate;
use Yajra\Datatables\Datatables;

class UsersController extends AdminController
{
    
    protected $user_rep;
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
//        $users = $this->user_rep->getPaginated(5);
        $this->scripts = view('datatables.users')->render();
        $this->content = view('admin.users_content')
//            ->with(['users' => $users])
            ->render();
        return $this->renderOutput();
    }
    
    public function getData()
    {
        $data = User::query();
        return Datatables::of($data)
            ->addColumn('action', function($data){
                $links = '<a href="' . route('users.edit', ['user' => $data->id])
                    . '"><span class="glyphicon glyphicon-pencil"></span></a>';
                $links .= '<a href="#" class="delete" data-model="users" data-id="' . $data->id
                    . '"><span class="glyphicon glyphicon-remove text-danger"></span></a>';
                return $links;
            })
            ->rawColumns(['action'])
            ->make(true);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('User_Register')){
            abort(403);
        }
        $this->validate($request, $this->rules);
        $result = $this->user_rep->saveUser($request, $id);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect(route('users.index'))->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $result = $user->delete();
        if(is_array($result) && !empty($result['error'])) {
            return response()->json(['error' => 'Неможливо видалити користувача ' . fullname($user)], 500);
        }
        return response()->json(['message' => 'Користувача видалено'], 200);
    }
    
    public function search(Request $request)
    {
        $searchTerm = '%' . $request->input('query') .'%';
        $users = User::where('firstname', 'like', $searchTerm)
            ->orWhere('middlename', 'like', $searchTerm)
            ->orWhere('lastname', 'like', $searchTerm)
            ->get();
        return view('search.users')
            ->with([
                'users' => $users,
                'name' => $request->input('query')
            ])
            ->render();
    }
}
