<?php declare(strict_types=1);

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Execution\ResolveInfo;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\ArgDirective;
use Nuwave\Lighthouse\Support\Contracts\ArgTransformerDirective;
use Nuwave\Lighthouse\Support\Contracts\FieldMiddleware;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpperCaseDirective extends BaseDirective implements FieldMiddleware
{
    // TODO implement the directive https://lighthouse-php.com/master/custom-directives/getting-started.html

    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<'GRAPHQL'
directive @upperCase on ARGUMENT_DEFINITION | INPUT_FIELD_DEFINITION | FIELD_DEFINITION
GRAPHQL;
    }

    public function handleField(FieldValue $fieldValue): void
    {
        $fieldValue->wrapResolver(fn (callable $resolver) => function (mixed $root, array $args, GraphQLContext $context, ResolveInfo $info) use ($resolver): string {
            // Call the resolver, passing along the resolver arguments
            $result = $resolver($root, $args, $context, $info);
            assert(is_string($result));

            return strtoupper($result);
        });
    }
}
