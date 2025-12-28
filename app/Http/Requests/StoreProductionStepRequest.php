<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductionStepRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'article_id' => 'required|exists:articles,id',
            'step' => 'required|string|max:255',
            'status' => 'in:pending,in_progress,completed',
            'cost' => 'nullable|numeric|min:0',
        ];
    }
}
