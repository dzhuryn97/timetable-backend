<?php

declare(strict_types=1);

namespace App\GraphQL\Directives;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nuwave\Lighthouse\Execution\Arguments\ResolveNested;
use Nuwave\Lighthouse\Execution\Arguments\SaveModel;
use Nuwave\Lighthouse\Execution\Arguments\UpsertModel;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Support\Contracts\ArgDirective;
use Nuwave\Lighthouse\Support\Contracts\ArgResolver;

final class OverrideHasManyDirective extends BaseDirective implements ArgDirective, ArgResolver
{
    public static function definition(): string
    {
        return
            /** @lang GraphQL */
            <<<'GRAPHQL'
                directive @overrideHasMany on INPUT_FIELD_DEFINITION
            GRAPHQL;
    }

    /**
     * @param  mixed  $root  The result of the parent resolver.
     * @return mixed|void|null May return the modified $root
     */
    public function __invoke($parent, $argsList): mixed
    {
        $relationName = $this->nodeName();
        /** @var HasMany $relation */
        $relation = $parent->{$relationName}();

        $nestedSave = new ResolveNested(new UpsertModel(new SaveModel($relation)));

        $persistedKeys = [];
        foreach ($argsList as $args) {
            $related = $relation->make();

            /** @var Model $persisted */
            $persisted = $nestedSave($related, $args);
            $persistedKeys[] = $persisted->getKey();
        }

        /** @var Model $relationModel */
        foreach ($parent->{$relationName} as $relationModel) {
            if (!in_array($relationModel->getKey(), $persistedKeys)) {
                $relationModel->delete();
            }
        }

        return null;
    }
}
