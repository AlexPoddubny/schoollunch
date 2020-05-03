<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NumRule implements Rule
{
    
    protected $minNum;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minNum)
    {
        $this->minNum = $minNum;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value > $this->minNum;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Maximum schoolnumber must be greater than minimum.';
    }
}
