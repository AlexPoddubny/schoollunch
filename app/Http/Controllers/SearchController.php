<?php
    
    namespace App\Http\Controllers;
    
    use App\User;
    use Illuminate\Http\Request;
    
    class SearchController extends Controller
    {
        public function search(Request $request)
        {
            if ($request->ajax()) {
                $name = $request->only('name');
                $users = User::where('firstname', $name['name'])
                    ->orWhere('middlename', $name['name'])
                    ->orWhere('lastname', $name['name'])
                    ->get();
                $this->content = view('search')
                    ->with(['users' => $users])
                    ->render();
                return $this->renderOutput();
            }
        }
    }
