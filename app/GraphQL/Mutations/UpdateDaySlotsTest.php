<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Film;
use App\Models\Doctor;
use Nuwave\Lighthouse\Execution\Arguments\ResolveNested;
use Nuwave\Lighthouse\Execution\Arguments\SaveModel;
use Nuwave\Lighthouse\Execution\Arguments\UpsertModel;

final readonly class UpdateDaySlotsTest
{
    /** @param  array{}  $args */
    public function __invoke($_, array $args)
    {
        $doctor = Doctor::find($args['doctorId']);

        $relation = $doctor->daySlots();


        foreach ($args['daySlots'] as $daySlot) {
            $related = $relation->make();
            $related->fill($daySlot);
            $related->save();
        }

        dd($args['daySlots']);
    }
}
