<?php

namespace App\Dto\Transformer;

abstract class AbstractDtoTransformer implements DtoTransformInterface
{
    public function transformFromObjects(iterable $objects): iterable
    {
        $dto = [];

        foreach ($objects as $object) {
            $dto[] = $this->transformFromObject($object);
        }
        return $dto;
    }
}
