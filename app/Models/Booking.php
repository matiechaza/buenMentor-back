<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $mentor_id
 * @property int $mentee_id
 * @property \Illuminate\Support\Carbon $session_date
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\User|null $mentee
 * @property-read \App\Models\Mentor|null $mentor
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $start_time
 * @property \Illuminate\Support\Carbon $end_time
 * @property string $amount
 * @property string $payment_status
 * @method static \Database\Factories\BookingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereMentorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUserId($value)
 * @property string $day
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDay($value)
 * @mixin \Eloquent
 */
final class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'user_id',
        'day',
        'start_time',
        'end_time',
        'amount',
        'status',
        'payment_status',
    ];

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    public function mentee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function startTime(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->format('H:i'),
        );
    }

    protected function endTime(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->format('H:i'),
        );
    }
}
