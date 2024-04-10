<?php

namespace App\Models;

class People implements Character
{
    private string $name;
    private int $sex;

    public function __construct(string $name, int $sex)
    {
        $this->name = $name;
        $this->sex = $sex;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSex(): int
    {
        return $this->sex;
    }
}
