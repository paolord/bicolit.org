<?php namespace App\Service\Validation;

interface ValidableInterface {

    /**
     * Add data to validation against
     *
     * @param array
     * @return \App\Service\Validation\ValidableInterface  $this
     */
    public function make(array $data, array $rules);

    /**
     * Test if validation passes
     *
     * @return boolean
     */
    public function passes();

    /**
     * Retrieve validation errors
     *
     * @return array
     */
    public function errors();

}
