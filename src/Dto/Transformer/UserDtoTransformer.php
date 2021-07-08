<?php

namespace App\Dto\Transformer;

use App\Dto\UserDto;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserDtoTransformer
 * @package App\Dto\Transformer
 */
class UserDtoTransformer extends AbstractDtoTransformer
{
    /**
     * @param UserInterface $object
     * @return UserDto
     */
    public function transformFromObject($object): UserDto
    {
        $dto = new UserDto();
        $dto->id = $object->getId();
        $dto->name = $object->getName();
        $dto->email = $object->getEmail();
        $dto->createdAt = $object->getCreatedAt();

        return $dto;
    }

}