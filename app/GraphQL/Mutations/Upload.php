<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Http\UploadedFile;

final readonly class Upload
{
    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {
        /** @var UploadedFile $file */
        $file = $args['file'];

        $res = $file->store('uploads');
        return $res;
    }
}
