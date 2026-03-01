<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\University;
use App\Models\Faculty;
use App\Models\CareerPath;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'university_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && $value !== 'other' && !University::where('id', $value)->exists()) {
                        $fail(__('The selected university is invalid.'));
                    }
                }
            ],
            'faculty_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && $value !== 'other' && !Faculty::where('id', $value)->exists()) {
                        $fail(__('The selected faculty is invalid.'));
                    }
                }
            ],
            'career_path_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && $value !== 'other' && !CareerPath::where('id', $value)->exists()) {
                        $fail(__('The selected career path is invalid.'));
                    }
                }
            ],
            'other_university' => ['nullable', 'string', 'max:255'],
            'other_faculty' => ['nullable', 'string', 'max:255'],
            'other_career_path' => ['nullable', 'string', 'max:255'],
            'cv' => ['nullable', 'string'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'years_experience' => ['nullable', 'integer', 'min:0'],
            'linkedin_url' => ['nullable', 'string', 'max:255'],
        ];
    }
}
