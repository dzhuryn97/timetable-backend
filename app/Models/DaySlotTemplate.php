<?php

namespace App\Models;

use App\Models\Enums\StatusEnum;
use Eloquence\Behaviours\HasCamelCasing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DaySlotTemplate
 *
 * @property int $id
 * @property int $dayNumber
 * @property string $status
 * @property string|null $workHours
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @method static \Database\Factories\DaySlotTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlotTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlotTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlotTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlotTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlotTemplate whereDayNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlotTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlotTemplate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlotTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlotTemplate whereWorkHours($value)
 * @property int $doctorId
 * @method static \Illuminate\Database\Eloquent\Builder|DaySlotTemplate whereDoctorId($value)
 * @mixin \Eloquent
 */
class DaySlotTemplate extends Model
{
    protected $casts = [
        'status' => StatusEnum::class,
    ];

    use HasFactory, HasCamelCasing;
}
