<?php

namespace App\Http\Controllers\Admin;

use App\BreakTime;
use App\Repositories\BreakTimesRepository;
use App\Repositories\SchoolClassesRepository;
use App\Repositories\SchoolsRepository;
use App\Repositories\UsersRepository;
use App\School;
use App\SchoolClass;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Validation\Rule;

class SchoolController
    extends AdminController
{
    
    protected $user_rep;
    protected $school_rep;
    protected $breaks_rep;
    protected $classes_rep;
    
    protected $related = [
        'admin',
        'cook',
        'breakTime',
        'schoolClass.teacher',
        'schoolClass.category',
        'schoolClass.breakTime'
    ];
    
    public function __construct(
        UsersRepository $user_rep,
        SchoolsRepository $school_rep,
        BreakTimesRepository $breaks_rep,
        SchoolClassesRepository $classes_rep
    )
    {
        parent::__construct();
        $this->user_rep = $user_rep;
        $this->school_rep = $school_rep;
        $this->breaks_rep = $breaks_rep;
        $this->classes_rep = $classes_rep;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index()
    {
        if ($this->user->hasRole('Admin')){
            $schools = School::all();
        } elseif ($this->user->hasRole('SchoolAdmin')){
            $schools = School::where('admin_id', $this->user->id)->get();
        } else {
            abort(403);
        }
        if (count($schools) > 0){
            if (count($schools) == 1){
                // redirect to school view
                return redirect(route('school.show', [
                    'school' => $schools->first()->id
                ]));
            } else {
                // fill the selector
                $this->content = view('selector')
                    ->with([
                        'schools' => $schools,
                        'route' => 'school.select'
                    ])
                    ->render();
            }
        } else {
            $this->content = 'Цей користувач не адмініструє жодної школи';
        }
        return $this->renderOutput();
    }
    
    public function select(Request $request)
    {
        return redirect(route('school.show', [
            'school' => $request->input('school')
        ]));
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
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function show($id)
    {
        $school = $this->school_rep->getWithRelated($id, $this->related)->first();
        $this->title .= $school->name;
        $this->content = view('admin.school_index')
            ->with([
                'school' => $school,
            ])
            ->render();
        return $this->renderOutput();
    }
    
    public function addBreak(Request $request)
    {
        if (Gate::denies('School_Edit')){
            abort(403);
        }
        $this->validate($request, [
            'break_num' => ['required', 'integer', 'min:1'],
            'begin' => ['required', 'date_format:H:i'],
            'end' => ['required', 'date_format:H:i', 'after:begin']
        ]);
        $data = $request->except('_token');
        $break = new BreakTime([
            'break_num' => $data['break_num'],
            'break_time' => $data['begin'] . ' - ' . $data['end']
        ]);
        $school = School::find($data['school_id']);
        $school->breakTime()->save($break);
        return redirect(route('school.show', [
            'school' => $data['school_id']
        ]));
    }
    
    public function addClass(Request $request)
    {
        if (Gate::denies('School_Edit')){
            abort(403);
        }
        $this->validate($request, [
            'name' => [
                'required',
                'regex:/(^[1-9][0-1]?-[А-Я]$)/u',
                Rule::unique('school_classes')->where(function ($query) use ($request){
                    return $query->where('school_id', $request->input('school_id'));
                })
            ]], [
            'name.unique' => 'Цей клас у школі вже існує',
            'name.regex' => 'Формат назви: 1-А...11-А'
        ]);
        $data = $request->except('_token');
        $schoolClass = new schoolClass([
            'name' => $data['name'],
        ]);
        $school = School::find($data['school_id']);
        $school->schoolClass()->save($schoolClass);
        return redirect(route('school.show', [
            'school' => $data['school_id']
        ]));
    }
    
    public function copyClass(Request $request)
    {
        dd($request);
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
