<?php

declare(strict_types=1);

namespace App\GraphQL\Directives;

use App\Models\DaySlot;
use App\Models\Doctor;
use Nuwave\Lighthouse\Execution\Arguments\ResolveNested;
use Nuwave\Lighthouse\Execution\Arguments\SaveModel;
use Nuwave\Lighthouse\Execution\Arguments\UpsertModel;
use Nuwave\Lighthouse\Execution\ResolveInfo;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\FieldResolver;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpdateDaySlotsDirective extends BaseDirective implements FieldResolver
{
    public static function definition(): string
    {
        return
            /** @lang GraphQL */
            <<<'GRAPHQL'
                directive @updateDaySlots on FIELD_DEFINITION
            GRAPHQL;
    }

    /**
     * @return \Nuwave\Lighthouse\Schema\Values\FieldValue
     */
    public function resolveField(FieldValue $fieldValue): callable
    {
        return function (mixed $root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo) {
            $doctor = Doctor::find($args['doctorId']);

            $relation = $doctor->daySlots();
            $nestedSave = new ResolveNested(new UpsertModel(new SaveModel($relation)));

            $persisted = [];

            foreach ($resolveInfo->argumentSet->arguments['daySlots']->value as $daySlot) {

                $related = $relation->make();
                /** @var DaySlot $persisted */
                $persisted[] = $nestedSave($related, $daySlot);
            }

            $persistedIds = array_map(function (DaySlot $daySlot) {
                return $daySlot->id;
            }, $persisted);

            $dateStart = \Carbon\Carbon::createFromDate($args['year'], $args['month'], 1)->startOfMonth();
            $dateEnd = \Carbon\Carbon::createFromDate($args['year'], $args['month'], 1)->endOfMonth();

            /** @var DaySlot[] $updatedMonthDaySlots */
            $updatedMonthDaySlots = $doctor->daySlots()
                ->where('date', '>=', $dateStart)
                ->where('date', '<=', $dateEnd)
                ->get();

            foreach ($updatedMonthDaySlots as $updatedMonthDaySlot) {
                if (!in_array($updatedMonthDaySlot->id, $persistedIds)) {
                    $updatedMonthDaySlot->delete();
                }
            }

            return $persisted;
        };
    }
}
