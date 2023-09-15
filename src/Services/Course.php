<?php

namespace DocasDev\LaravelMoodle\Services;

use DocasDev\LaravelMoodle\Entities\Course as CourseItem;
use DocasDev\LaravelMoodle\Entities\Dto\Course as CourseDto;
use DocasDev\LaravelMoodle\Entities\CourseCollection;

/**
 * Class Course
 * @package DocasDev\LaravelMoodle\Services
 */
class Course extends Service
{
    /**
     * Get all courses by ids
     * @param array $ids
     * @return CourseCollection
     */
    public function getAll(array $ids = [])
    {
        $response = $this->sendRequest('core_course_get_courses', ['options' => ['ids' => $ids]]);

        return $this->getCourseCollection($response);
    }

    /**
     * Get course by field
     * @param $field
     * @param $value
     * @return CourseCollection
     */
    public function getByField($field, $value)
    {
        $arguments = [
            'field' => $field,
            'value' => $value,
        ];

        $response = $this->sendRequest('core_course_get_courses_by_field', $arguments);

        return $this->getCourseCollection($response['courses']);
    }

    /**
     * Create new course
     * @param \DocasDev\LaravelMoodle\Entities\Dto\Course[] ...$courses
     * @return CourseCollection
     */
    public function create(CourseDto ...$courses)
    {
        $response = $this->sendRequest(
            'core_course_create_courses',
            [
                'courses' => $this->prepareEntityForSending(...$courses)
            ]
        );

        return $this->getCourseCollection($response);
    }

    /**
     * Delete courses by ids
     * @param array $ids
     * @return mixed
     */
    public function delete(array $ids = [])
    {
        $response = $this->sendRequest('core_course_delete_courses', ['courseids' => $ids]);

        return $response;
    }

    /**
     * Get course collection by course array
     * @param array $courses
     * @return CourseCollection
     */
    protected function getCourseCollection(array $courses)
    {
        $courseItems = [];
        foreach ($courses as $courseItem) {
            $courseItems[] = new CourseItem($courseItem);
        }

        return new CourseCollection(...$courseItems);
    }
}
