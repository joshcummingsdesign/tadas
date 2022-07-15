<?php

namespace Domain\Tadas\Models;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tada model.
 *
 * @since 1.0.0
 * @mixin IdeHelperTada
 */
class Tada extends Model {
  use HasFactory;

  /**
   * The model's attributes.
   *
   * @since 1.0.0
   *
   * @var array
   */
  protected $attributes = [
    'is_completed' => false,
    'index' => 999,
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @since 1.0.0
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'user_id',
    'tada_list_id',
    'name',
    'is_completed',
    'index',
  ];

  /**
   * The attributes that should be cast.
   *
   * @since 1.0.0
   *
   * @var array<string, string>
   */
  protected $casts = [
    'is_completed' => 'boolean',
  ];

  /**
   * Get the user a tada belongs to.
   *
   * @since 1.0.0
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the tada list a tada belongs to.
   *
   * @since 1.0.0
   */
  public function tadaList(): BelongsTo {
    return $this->belongsTo(TadaList::class);
  }
}
