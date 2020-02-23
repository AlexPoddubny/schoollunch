<?php
    
    use App\User;
    
    function fullname(User $user)
    {
        return $user->lastname . ' ' .$user->firstname . ' ' . $user->middlename;
    }
