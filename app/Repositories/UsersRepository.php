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
    
        public function saveUser($request)
        {
            $data = $request->except('_token');
            $roles = [];
            if (isset($data['roles'])){
                $roles = $data['roles'];
                unset($data['roles']);
            }
            $user = $this->getWhere($request->input('id'))->first();
            $user->fill($data);
            $user->save();
            $user->saveRoles($roles);
            return ['status' => 'Дані користувача оновлено'];
        }
    
        public function saveChild($request, $user)
        {
            $user->saveChild($request->input('student'));
            $user->addRole('Parent');
            return ['status' => 'Дитину додано'];
        }
        
    }
