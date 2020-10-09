<?php

namespace App\Http\Controllers;

use App\Course;
use App\Repositories\CoursesRepository;
use App\Size;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index()
    {
        $this->title = 'Меню комбінату харчування';
        $this->content = view('courses')
            ->with([
                'allcourses' => Course::with('product', 'type')
                    ->get()
                    ->sortBy('type.sort')
                    ->groupBy('type.name')
            ])
            ->render();
        return $this->renderOutput();
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function show($id, $size = 6)
    {
        if (!($course = Course::with('product')->find($id))){
            abort(403);
        }
        $this->content = view('course')
            ->with([
                'course' => $course,
                'size' => Size::find($size)
            ])
            ->render();
        return $this->renderOutput();
    }
    
}
