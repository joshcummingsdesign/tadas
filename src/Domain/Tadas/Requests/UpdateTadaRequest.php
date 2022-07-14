<?php

namespace Domain\Tadas\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Update tada request.
 *
 * @since 1.0.0
 */
class UpdateTadaRequest extends FormRequest {
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
      'name' => 'string|max:255',
      'is_completed' => 'boolean',
    ];
  }
}
