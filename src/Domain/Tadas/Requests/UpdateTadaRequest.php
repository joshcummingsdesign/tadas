<?php

namespace Domain\Tadas\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Update tada request.
 *
 * @unreleased
 */
class UpdateTadaRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @unreleased
   */
  public function authorize(): bool {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @unreleased
   */
  public function rules(): array {
    return [
      'name' => 'string|max:255',
      'is_completed' => 'boolean',
    ];
  }
}
