<?php declare(strict_types=1);

namespace App\GraphQL\Types\Doctor;

use App\Exceptions\CustomException;
use App\Models\Doctor;

final readonly class Description
{
    /** @param  array{}  $args */
    public function __invoke(Doctor $_, array $args)
    {
        $data = $_->description;
        if(isset($args['len'])){
            $data = substr($data,0,$args['len']);
        }
       return $data;
    }
}
