<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AlphaNumericSpace implements ValidationRule
{
    // alpha numeric space allows letters, numbers and spaces only, along with the characters provided in the parameters

    private $params; // var to store the provided parameters

    public function __construct($things = [])
    {
        $this->params = $things; // store the provided parameters
    }
    
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /* 
         * check if there are any paramaters
         * if yes:
         *      add the provided parameters into the baseline regex -- /^([a-z ${parameters}])*$/i
         *      add the provided parameters into the baseline error string -- 'The :attribute field must only contain letters, numbers and spaces, and characters ${parameters}.'
         * if no:
         *      set the regex pattern to the baseline -- /^([a-z ])*$/i
         *      set the error string to the baseline -- 'The :attribute field must only contain letters, numbers and spaces.'
         * 
         * test the chosen regex and call $fail with chosen error message if it fails
         */

        // check for params
        if(!empty($this->params)) // if any:
        {
            // move the dash character to the end of the params array if it exists and is not already at the end
                // this is done because if a dash(-) is anywhere but at the end of a character class, regex treats it as a range which may cause unwanted behaviour
            $dashIndex = array_search("-", $this->params);
            if(isset($dashIndex) && $dashIndex != count($this->params) - 1)
            {
                unset($this->params[$dashIndex]);
                array_push($this->params, "-");
            }

            // set the regex
            $pattern = '/^([a-z0-9 ' . implode($this->params) . '])*$/i';
            
            // set the err msg
            $errorMessage = 'The :attribute field must only contain letters, numbers and spaces, and characters \'' . implode("', '", $this->params) . '\'.';
        }
        else // if none:
        {
            // set the regex
            $pattern = '/^([a-z ])*$/i';
            
            // set the err msg
            $errorMessage = 'The :attribute field must only contain letters, numbers and spaces.';
        }


        if(!preg_match($pattern, $value))
        {
            $fail($errorMessage);
        }
    }
}
