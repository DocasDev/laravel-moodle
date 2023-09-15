<?php

namespace DocasDev\LaravelMoodle\Entities;

use DocasDev\LaravelMoodle\GenericCollection;

/**
 * Class CourseCollection
 * @package DocasDev\LaravelMoodle\Entities
 */
class CourseCollection extends GenericCollection
{
    /**
     * CourseCollection constructor.
     * @param Course[] ...$courses
     */
    public function __construct(Course ...$courses)
    {
        $this->items = $courses;
    }

    /**
     * Add course to collection
     * @param Course $item
     */
    public function add(Course $item)
    {
        $this->items[$item->id] = $item;
    }

    /**
     * Remove course from collection
     * @param Course|integer $course
     */
    public function remove($course)
    {
        $id = ($course instanceof Course) ? $course->id : $course;
        if (array_key_exists($id, $this->items)) {
            unset($this->items[$id]);
        }
    }
}
