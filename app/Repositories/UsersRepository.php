<?php
    
    
    namespace App\Repositories;
    
    
    use App\User;

    class UsersRepository
        extends Repository
    {
        public function __construct(User $user)
        {
            $this->model = $user;
        }
    
        public function saveChild($request, $user)
        {
            $user->saveChild($request->input('student'));
            $user->addRole('Parent');
            return ['status' => 'Дитину додано'];
        }
        
    }
