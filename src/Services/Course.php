<?php

namespace DocasDev\LaravelMoodle\Services;

use DocasDev\LaravelMoodle\Entities\Course as CourseEntity;
use DocasDev\LaravelMoodle\Entities\CourseCollection;
use DocasDev\LaravelMoodle\Entities\Dto\CourseDTO;

class Course extends Service
{
    public function getByPrimaryKey(int $id): CourseCollection
    {
        return $this->getByField('id', $id);
    }

    public function getAll(array $ids = []): CourseCollection
    {
        $response = $this->sendRequest('core_course_get_courses', ['options' => ['ids' => $ids]]);

        return $this->getCourseCollection($response);
    }

    public function getByField(string $field, mixed $value): CourseCollection
    {
        $arguments = [
            'field' => $field,
            'value' => $value,
        ];

        $response = $this->sendRequest('core_course_get_courses_by_field', $arguments);

        return $this->getCourseCollection($response['courses']);
    }

    public function create(CourseDTO ...$courses): CourseCollection
    {
        $response = $this->sendRequest(
            'core_course_create_courses',
            [
                'courses' => $this->prepareEntityForSending(...$courses)
            ]
        );

        return $this->getCourseCollection($response);
    }

    public function delete(array $ids = []): mixed
    {
        $response = $this->sendRequest('core_course_delete_courses', ['courseids' => $ids]);

        return $response;
    }

    protected function getCourseCollection(array $courses): CourseCollection
    {
        $courseEntities = [];
        foreach ($courses as $courseEntity) {
            $courseEntities[] = CourseEntity::create($courseEntity);
        }

        return new CourseCollection(...$courseEntities);
    }
}
