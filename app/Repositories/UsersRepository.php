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
            $data = $request->only('student');
            $user->saveChild($data['student']);
            $user->addRole('Parent');
            return ['status' => 'Дитину додано'];
        }
        
    }
