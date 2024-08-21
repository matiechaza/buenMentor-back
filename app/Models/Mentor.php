<?php

namespace App\Models;

use Digikraaft\ReviewRating\Traits\HasReviewRating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $rate
 * @property array $availability
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Booking> $bookings
 * @property-read int|null $bookings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Digikraaft\ReviewRating\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\User|null $user
 * @property string|null $social_links
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Availability> $availabilities
 * @property-read int|null $availabilities_count
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor allReviews()
 * @method static \Database\Factories\MentorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereSocialLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor withRatings()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor withoutTrashed()
 * @mixin \Eloquent
 */
final class Mentor extends Model
{
    use HasReviewRating;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'rate',
    ];

    protected $with = [
        'user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function availabilities(): HasMany
    {
        return $this->hasMany(Availability::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
