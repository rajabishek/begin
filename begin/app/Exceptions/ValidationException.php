<?php

namespace Begin\Exceptions;

use Exception;

class ValidationException extends Exception
{
    /**
     * The underlying errors instance.
     *
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Create a new ValidationException exception instance.
     *
     * @param  \Illuminate\Support\MessageBag  $errors
     * @return void
     */
    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    /**
     * Get the request validation errors
     *
     * @return @var \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
