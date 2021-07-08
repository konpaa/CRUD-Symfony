<?php

namespace App\Dto\Transformer;

use App\Dto\ArticleDto;
use App\Entity\Article;

class ArticleDtoTransformer extends AbstractDtoTransformer
{
    /**
     * @param Article $object
     * @return ArticleDto
     */
    public function transformFromObject($object): ArticleDto
    {
        $dto = new ArticleDto();
        $dto->id = $object->getId();
        $dto->name = $object->getName();
        $dto->body = $object->getBody();
        $dto->createdAt = $object->getCreatedAt();
        $dto->updatedAt = $object->getUpdatedAt();
        $dto->photoFilename = $object->getPhotoFilename();
        $dto->creator = $object->getCreator();

        return $dto;
    }
}
