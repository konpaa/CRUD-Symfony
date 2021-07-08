<?php

namespace App\Dto;

use DateTimeInterface;

class UserDto
{
    /**
     * @Serialization\Type("int)
     */
    public ?int $id = null;

    /**
     * @Serialization\Type("string")
     */
    public string $email;

    /**
     * @Serialization\Type("string")
     */
    public string $name;

    /**
     * @Serialization\Type("DateTimeInterface")
     */
    public DateTimeInterface $createdAt;
}
