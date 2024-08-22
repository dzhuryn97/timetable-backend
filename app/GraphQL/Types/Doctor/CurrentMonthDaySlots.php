<?php declare(strict_types=1);

namespace App\GraphQL\Types\Doctor;

use App\Models\Doctor;

final readonly class CurrentMonthDaySlots
{
    /** @param  array{}  $args */
    public function __invoke(Doctor $_, array $args)
    {
        $dateStart = \Carbon\Carbon::now();
        $dateEnd = \Carbon\Carbon::now();


        return  $_->daySlots()
            ->where('date','>=',$dateStart->startOfMonth())
            ->where('date','<=',$dateEnd->endOfMonth())
            ->get();
    }
}
