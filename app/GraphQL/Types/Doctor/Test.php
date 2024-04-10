<?php declare(strict_types=1);

namespace App\GraphQL\Types\Doctor;

final readonly class Test
{
    /** @param  array{}  $args */
    public function __invoke(mixed $_, array $args)
    {

        $data ='blablacar';
        if(isset($args['max'])){
            $data = substr($data,0,$args['max']);
        }
        return $data;
    }
}
