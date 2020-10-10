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
    
        public function saveUser($request, $id)
        {
            $data = $request->except('_token');
            $roles = [];
            if (isset($data['roles'])){
                $roles = $data['roles'];
                unset($data['roles']);
            }
            $user = User::findOrFail($id);
            $user->update($data);
            $user->saveRoles($roles);
            return ['status' => 'Дані користувача оновлено'];
        }
    
        public function saveChild($request, $user)
        {
            $user->saveChild($request->input('student'));
            $user->addRole('Parent');
            return ['status' => 'Дитину додано'];
        }
    
        public function detachChild($child, $user)
        {
            $user->removeChild($child);
            if (count($user->child) == 0){
                $user->removeRole('Parent');
            }
            return ['status' => 'Школяра видалено зі списку'];
        }
        
    }
