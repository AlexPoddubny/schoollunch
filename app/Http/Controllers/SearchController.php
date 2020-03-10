<?php
    
    namespace App\Http\Controllers;
    
    use App\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Arr;

    class SearchController extends Controller
    {
        public function search(Request $request)
        {
            if ($request->ajax()) {
                $name = $request->only('adminname');
                $users = User::where('firstname', $name['adminname'])
                    ->orWhere('middlename', $name['adminname'])
                    ->orWhere('lastname', $name['adminname'])
                    ->get();
                $search = view('layouts.search')
                    ->with(['users' => $users])
                    ->render();
                $this->vars = Arr::add($this->vars, 'search', $search);
                return $this->renderOutput();
            }
        }
    }
