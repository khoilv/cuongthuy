<?php
namespace App\Forms;

use App\Forms\BaseForm;

class JobForm extends BaseForm
{
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'category_id'    => 'Integer|Min:0|Max:3',
            'type' => 'required',
            'company' => 'required',
            'position' => 'required',
            'location' => 'required',
            'description' => 'required',
            'how_to_apply' => 'required|max:255',
            'email' => 'Required|Email',
            'url' => 'required|Url',
            'logo' => 'image'
        ];
    }

}
