<?php namespace App\Service\Validation;

use Validator;

class LaravelValidator implements ValidableInterface {

    /**
     * Validator
     *
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;

    /**
     * Validation data key => value array
     *
     * @var Array
     */
    protected $data = array();

    /**
     * Validation errors
     *
     * @var Array
     */
    protected $errors = array();

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array();

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Set data to validate
     *
     * @return \App\Service\Validation\AbstractLaravelValidator
     */
    public function make(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;

        return $this;
    }

    /**
     * Validation passes or fails
     *
     * @return Boolean
     */
    public function passes()
    {
        $validator = Validator::make($this->data, $this->rules);

        if( $validator->fails() )
        {
            $this->errors = $validator->messages();
            return false;
        }

        return true;
    }

    /**
     * Return errors, if any
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

}
