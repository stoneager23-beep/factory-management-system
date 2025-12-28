<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'article_id' => 'required|exists:articles,id',
            'customer_id' => 'required|exists:customers,id',
            'with_gst' => 'boolean',
        ];
    }
}
