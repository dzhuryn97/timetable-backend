<?php

namespace App\Models;

use App\Models\Enums\StatusEnum;
use Eloquence\Behaviours\HasCamelCasing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\DaySlot
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $date
 * @property int $doctorId
 * @property StatusEnum $status
 * @property string|null $workHours
 * @property string|null $absentReason
 * @property int|null $replacementId
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\Doctor|null $replacement
 *
 * @method static \Database\Factories\DaySlotFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot query()
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot whereAbsentReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot whereReplacementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlot whereWorkHours($value)
 *
 * @mixin \Eloquent
 */
class DaySlot extends Model
{
    use HasCamelCasing;
    use HasFactory;

    protected $casts = [
        'status' => StatusEnum::class,
        'date' => 'datetime:Y-m-d',
    ];

    public function replacement(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
