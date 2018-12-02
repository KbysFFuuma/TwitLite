<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{

    public function profileChanged(Request $request) {
        $loginUser = Auth::user();

        $isChanged = true;
        return view('/settingPage', compact('loginUser', 'isChanged'));
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      if ($this->path() == 'setting') {
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
          'userId' => 'required|regex:/^[0-9a-zA-Z_\.\-]+$/',
          'name' => 'required',
          'icon' => 'image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
