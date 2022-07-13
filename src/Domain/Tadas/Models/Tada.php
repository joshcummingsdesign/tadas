<?php

namespace Domain\Tadas\Models;

use Domain\User\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tada model.
 *
 * @unreleased
 *
 * @mixin Eloquent
 */
class Tada extends Model {
  use HasFactory;

  /**
   * The model's attributes.
   *
   * @unreleased
   *
   * @var array
   */
  protected $attributes = [
    'is_completed' => false,
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @unreleased
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
   * @unreleased
   *
   * @var array<string, string>
   */
  protected $casts = [
    'is_completed' => 'boolean',
  ];

  /**
   * Get the user a tada belongs to.
   *
   * @unreleased
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the tada list a tada belongs to.
   *
   * @unreleased
   */
  public function tadaList(): BelongsTo {
    return $this->belongsTo(TadaList::class);
  }
}
