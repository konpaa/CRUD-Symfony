<?php


namespace App\Dto\Transformer;


interface DtoTransformInterface
{
    public function transformFromObject($object);
    public function transformFromObjects(iterable $objects): iterable;
}