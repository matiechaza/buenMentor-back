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
 * @property string $day
 * @property string $start_time
 * @property string $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Mentor $mentor
 * @method static \Database\Factories\AvailabilityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Availability newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Availability newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Availability query()
 * @method static \Illuminate\Database\Eloquent\Builder|Availability whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Availability whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Availability whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Availability whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Availability whereMentorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Availability whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Availability whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'day',
        'start_time',
        'end_time',
    ];

    protected $with = [
        'mentor'
    ];

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
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
