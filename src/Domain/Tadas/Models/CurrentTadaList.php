<?php

namespace Domain\Tadas\Models;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * CurrentTadaList model.
 *
 * @since 1.0.0
 * @mixin IdeHelperCurrentTadaList
 */
class CurrentTadaList extends Model {
  use HasFactory;

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
  ];

  /**
   * Get the user a current tada list belongs to.
   *
   * @since 1.0.0
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }
}
