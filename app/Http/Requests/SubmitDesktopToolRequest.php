<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SubmitDesktopToolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Handle proper error message
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
        return [
            'name' => 'required',
            'url' => 'required',
            'description' => 'required',
            'user_data' => 'required',
            'api' => 'required|boolean',
            'api_data' => 'required_if:api,1',
            'api_scopes' => 'required_if:api,1',
            'api_scopes_description' => 'required_if:api,1',
            'tos' => 'required|boolean',
            'tos_url' => 'required_if:tos,1',
            'open_source' => 'required|boolean',
            'open_source_url' => 'required_if:open_source,1',
            'beta' => 'required|boolean',
            'beta_description' => 'required_if:beta,1'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'api_data.required_if' => 'Please specify what data you plan to store from the Twitch API.',
            'api_scopes.required_if' => 'Please specify what Twitch API scopes you require.',
            'api_scopes_description.required_if' => 'Please specify what you require each Twitch API scope for.',
            'tos_url.required_if' => 'Please specify a URL to your Terms of Service.',
            'open_source_url.required_if' => 'Please specify a URL to your code.',
            'beta_description.required_if' => 'Please specify what changes you expect when leaving beta.'
        ];
    }
}
