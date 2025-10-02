<?php

namespace App\Filament\Resources\Trainings\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTrainingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'tanggal_mulai' => 'required|date',
			'tanggal_selesai' => 'required|date',
			'ruangan' => 'required',
			'kode_materi' => 'required'
		];
    }
}
