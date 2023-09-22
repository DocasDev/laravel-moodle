<?php

namespace DocasDev\LaravelMoodle\Services;

use DocasDev\LaravelMoodle\Entities\CategoryCollection;
use DocasDev\LaravelMoodle\Entities\Category as CategoryEntity;
use DocasDev\LaravelMoodle\Entities\Dto\CategoryDTO;
use SimpleXMLElement;

class Category extends Service
{
    public function getByPrimaryKey(int $id): CategoryCollection
    {
        $arguments = [
            [
                'key' => 'id',
                'value' => $id,
            ]
        ];
        return $this->getByField($arguments);
    }

    public function getAll(array $ids = []): CategoryCollection
    {
        $response = $this->sendRequest('core_course_get_categories', ['criteria' => ['ids' => join(',', $ids)]]);

        return $this->getCategoryCollection($response);
    }

    public function getByField(array $arguments): CategoryCollection
    {
        $response = $this->sendRequest('core_course_get_categories', ['criteria' => $arguments]);

        return $this->getCategoryCollection($response);
    }

    public function create(CategoryDTO ...$category): CategoryCollection
    {
        $response = $this->sendRequest(
            'core_course_create_categories',
            [
                'categories' => $this->prepareEntityForSending(...$category)
            ]
        );

        return $this->getCategoryCollection($response);
    }

    public function delete(int $id, int $recursive = 0, int $newparent = 0): mixed
    {
        $arguments = [
            [
                'id' => $id,
                'recursive' => $recursive,
            ]
        ];

        if($recursive === 0)
            $arguments[0]['newparent'] = $newparent;

        $response = $this->sendRequest('core_course_delete_categories', ['categories' => $arguments]);

        return $response;
    }

    protected function getCategoryCollection(array $categories): CategoryCollection
    {
        $categoryEntities = [];
        foreach ($categories as $categoryEntity) {
            if($categoryEntity instanceof SimpleXMLElement)
                $categoryEntity = $this->parseXMLToArray($categoryEntity);

            $categoryEntities[] = CategoryEntity::create($categoryEntity);
        }

        return new CategoryCollection(...$categoryEntities);
    }
}
