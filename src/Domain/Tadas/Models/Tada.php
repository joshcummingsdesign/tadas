<?php

namespace Domain\Tadas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tada extends Model {
  use HasFactory;

  /**
   * The model's attributes.
   *
   * @var array
   */
  protected $attributes = [
    'is_completed' => false,
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'user_id',
    'tada_list_id',
    'name',
    'is_completed',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'is_completed' => 'boolean',
  ];
}
