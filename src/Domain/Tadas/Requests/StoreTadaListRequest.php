<?php

namespace Domain\Tadas\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Store tada list request.
 *
 * @since 1.0.0
 */
class StoreTadaListRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @since 1.0.0
   */
  public function authorize(): bool {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @since 1.0.0
   */
  public function rules(): array {
    return [
      'name' => 'required|string|max:255',
    ];
  }
}
