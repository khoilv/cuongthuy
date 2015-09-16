<?php
// File: app\Acme\Forms\BaseForm.php

namespace App\Forms;

use Illuminate\Support\MessageBag;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\Validator;

abstract class BaseForm
{
    /**
     * @var Validator
     */
    protected $validation;

    /**
     * @var \Illuminate\Validation\Factory
     */
    private $validator;

    /**
     * @param \Illuminate\Validation\Factory $validator
     */
    public function __construct(ValidatorFactory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $formData
     *
     * @throws FormValidationException
     */
    public function validate(array $formData)
    {
        // Instantiate validator instance by factory
        $this->validation = $this->validator->make($formData, $this->rules());

        // Validate
        if ($this->validation->fails()) {
             throw new FormValidationException('Validation Failed', $this->getValidationErrors());
        }

        return true;
    }

    /**
     * @return MessageBag
     */
    protected function getValidationErrors()
    {
        return $this->validation->errors();
    }

    /**
     * @return array
     */
    abstract protected function rules();
}