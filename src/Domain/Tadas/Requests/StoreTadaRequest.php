<?php

namespace Domain\Tadas\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Store tada request.
 *
 * @unreleased
 */
class StoreTadaRequest extends FormRequest {
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
      'name' => 'required|string|max:255',
    ];
  }
}
