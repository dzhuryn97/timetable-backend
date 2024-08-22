<?php declare(strict_types=1);

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;
use Illuminate\Validation\Rule;

final class UpdateUserInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'email',
                Rule::unique('users', 'email')->ignore($this->arg('id'), 'id'),
            ],
        ];
    }
}
