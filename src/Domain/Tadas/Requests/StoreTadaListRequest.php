<?php

namespace Domain\Tadas\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTadaListRequest extends FormRequest {
  /**
   * Get the validation rules that apply to the request.
   */
  public function prepareForValidation(): void {
    //
  }

  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array {
    return [];
  }
}
