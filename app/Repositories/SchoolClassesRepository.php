<?php
    
    
    namespace App\Repositories;
    
    
    use App\School;
    use App\SchoolClass;
    use App\User;

    class SchoolClassesRepository
        extends Repository
    {
        
        protected $user_rep;
        
        public function __construct(
            SchoolClass $schoolClass,
            UsersRepository $user_rep
        )
        {
            $this->model = $schoolClass;
            $this->user_rep = $user_rep;
        }
    
        public function saveClass($request, $id)
        {
            $data = $request->except('_token');
            $schoolClass = SchoolClass::find($id);
            $schoolClass->fill($data);
            if (isset($data['teacher_id'])){
                $user = User::find($data['teacher_id']);
                if ($user && !$user->hasRole('ClassTeacher')){
                    $user->addRole('ClassTeacher');
                }
            }
            $schoolClass->save();
            return ['status' => 'Інформацію про клас оновлено'];
        }
        
    }
