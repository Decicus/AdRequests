<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\User;

class SubmitDesktopToolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!empty(Auth::user()->twitch)) {
            return true;
        }
        
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validators = [
            'name' => 'required',
            'url' => 'required',
            'description' => 'required',
            'user_data' => 'required',
            'api' => 'required|boolean',
            'tos' => 'required|boolean',
            'open_source' => 'required|boolean',
            'beta' => 'required|boolean'
        ];
        
        $optional = [
            'api' => [
                'data',
                'scopes',
                'scopes_desc'
            ],
            'tos' => [
                'url'
            ],
            'open_source' => [
                'url'
            ],
            'beta' => [
                'desc'
            ]
        ];
        
        foreach ($optional as $name => $fields) {
            if (!$this->input($name, false)) {
                continue;
            }
            
            foreach ($fields as $field) {
                $validators[$name . '_' . $field] = 'required';
            }
        }
                
        return $validators;
    }
}
