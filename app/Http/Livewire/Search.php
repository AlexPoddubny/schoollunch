<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class Search extends Component
{
    
    public $searchTerm;
    public $users;
    
    public function render()
    {
        $this->users = [];
        if($this->searchTerm){
            $searchTerm = '%' . $this->searchTerm . '%';
            $this->users = User::where('lastname', 'like', $searchTerm)
                ->orWhere('firstname', 'like', $searchTerm)
                ->orWhere('middlename', 'like', $searchTerm)
                ->get();
        }
        return view('livewire.search');
    }
    
}
