<?php

namespace App\Dto;

use DateTimeInterface;
use JMS\Serializer\Annotation as Serialization;

class ArticleDto
{
    /**
     * @Serialization\Type("int)
     */
    public ?int $id = null;

    /**
     * @Serialization\Type("string")
     */
    public string $name;

    /**
     * @Serialization\Type("string")
     */
    public string $body;

    /**
     * @Serialization\Type("DateTime<Y-m-d\TH:i:s>")
     */
    public DateTimeInterface $updated_at;
}
