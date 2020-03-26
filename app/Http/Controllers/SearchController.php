<?php
    
    namespace App\Http\Controllers;
    
    use App\Student;
    use App\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Arr;
    use Spatie\Searchable\Search;

    class SearchController extends Controller
    {
        /*public function search(Request $request)
        {
            if ($request->ajax()) {
                $name = $request->only('searchTerm');
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
        }*/
    
        public function search(Request $request)
        {
            $searchTerm = $request->input('query');
            $searchResults = (new Search())
                ->registerModel(Student::class, 'fullname')
                ->perform($searchTerm);
            return view('search', compact('searchResults', 'searchTerm'))->render();
        }
        
    }
