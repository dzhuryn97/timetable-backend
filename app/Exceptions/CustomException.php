<?php

namespace App\Exceptions;

use GraphQL\Error\ClientAware;
use GraphQL\Error\ProvidesExtensions;

class CustomException extends \DomainException implements ClientAware, ProvidesExtensions
{

    public function isClientSafe(): bool
    {
        return true;

    }

    public function getExtensions(): ?array
    {
        return  [
            'bla'=>'bla'
        ];
    }
}
