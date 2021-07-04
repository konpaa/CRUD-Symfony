<?php

namespace App\Dto\Transformer;

use App\Dto\ArticleDto;
use App\Entity\Article;

class ArticleDtoTransformer extends AbstractDtoTransformer
{
    /**
     * @param Article $article
     *
     * @return ArticleDto
     */
    public function transformFromObject($article): ArticleDto
    {
        $dto = new ArticleDto();
        $dto->id = $article->getId();
        $dto->name = $article->getName();
        $dto->body = $article->getBody();
        $dto->createdAt = $article->getCreatedAt();
        $dto->updatedAt = $article->getUpdatedAt();

        return $dto;
    }
}
