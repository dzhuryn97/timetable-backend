<?php

namespace App\Providers;

use App\Models\Enums\StatusEnum;
use App\Models\Enums\UserRoleEnum;
use GraphQL\Type\Definition\EnumType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\PhpEnumType;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Schema\TypeRegistry;

class GraphQLServiceProvider extends ServiceProvider
{
    public function boot(TypeRegistry $typeRegistry)
    {
        $statusEnumType = new PhpEnumType(StatusEnum::class);
        $userRoleEnum = new PhpEnumType(UserRoleEnum::class);

        $typeRegistry->register($statusEnumType,);
        $typeRegistry->register($userRoleEnum);
    }
}
