<?php

namespace App\Dto;

use DateTime;
use JMS\Serializer\Annotation as Serialization;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @Serialization\Type("DateTime<'Y-m-d\TH:i:s'>")
     */
    public DateTime $createdAt;

    /**
     * @Serialization\Type("DateTime<'Y-m-d\TH:i:s'>")
     */
    public ?DateTime $updatedAt = null;

    /**
     * @Serialization\Type("string")
     */
    public ?string $photoFilename;

    /**
     * @Serialization\Type("UserInterface")
     */
    public UserInterface $creator;
}
