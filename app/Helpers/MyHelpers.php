<?php
    
    use App\User;
    
    function fullname(User $user)
    {
        return $user->lastname . ' ' . $user->firstname . ' ' . $user->middlename;
    }
    
    function after($haystack, $needle)
    {
        return substr($haystack, strpos($haystack, $needle) + strlen
            ($needle));
    }
    
    function before($haystack, $needle)
    {
        return substr($haystack, 0, strpos($haystack, $needle));
    }
    
    function between($after, $before, $haystack)
    {
        return before(after($haystack, $after), $before);
    }
