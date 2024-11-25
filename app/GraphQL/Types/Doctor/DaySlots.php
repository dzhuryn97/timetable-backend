<?php

declare(strict_types=1);

namespace App\GraphQL\Types\Doctor;

use App\Models\Doctor;

final readonly class DaySlots
{
    public function __invoke(Doctor $_, array $args)
    {

        $dateStart = \Carbon\Carbon::createFromDate($args['year'], $args['month']);
        $dateEnd = \Carbon\Carbon::createFromDate($args['year'], $args['month']);

        return $_->daySlots()
            ->where('date', '>=', $dateStart->startOfMonth())
            ->where('date', '<=', $dateEnd->endOfMonth())
            ->get();
    }
}
