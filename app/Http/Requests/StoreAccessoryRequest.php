<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccessoryRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'required|string|max:20',
        ];
    }
}
