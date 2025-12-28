<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'article_id' => 'nullable|exists:articles,id',
            'type' => 'required|in:purchase,issue,adjustment',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'required|string|max:20',
        ];
    }
}
