<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Doctor
 *
 * @property int $id
 * @property string $name
 * @property string $photo
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DaySlot> $daySlots
 * @property-read int|null $daySlotsCount
 *
 * @method static \Database\Factories\DoctorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereUpdatedAt($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DaySlotTemplate> $daySlotTemplates
 * @property-read int|null $daySlotTemplatesCount
 *
 * @mixin \Eloquent
 */
class Doctor extends Model
{
    use HasFactory;



    public function daySlots(): HasMany
    {
        return $this->hasMany(DaySlot::class)->orderBy('date');
    }

    public function daySlotTemplates(): HasMany
    {
        return $this->hasMany(DaySlotTemplate::class);
    }

    protected static function booted()
    {
        static::deleting(function (Doctor $doctor) {
            self::deleteReferences($doctor);
        });
    }

    private static function deleteReferences(Doctor $doctor): void
    {
        $doctor->daySlots()->delete();
        $daySlots = DaySlot::whereReplacementId($doctor->id)->get();
        foreach ($daySlots as $daySlot) {
            $daySlot->replacement()->disassociate();
            $daySlot->save();
        }
    }
}
