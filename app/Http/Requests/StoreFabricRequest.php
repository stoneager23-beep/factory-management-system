<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreFabricRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'type' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'required|in:meter,yard,kg',
        ];
    }
}
