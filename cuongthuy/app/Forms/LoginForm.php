<?php
namespace App\Forms;

use App\Forms\BaseForm;

class LoginForm extends BaseForm
{
    /**
     * @return array
     */
    protected function rules()
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'max:20', 'min:6', 'regex:/\A[a-z\d|!?_-]+\z/i'],
            'remember' => 'sometimes|numeric|min:1|max:1'
        ];
        return $rules;
    }

}
