<?php

namespace DocasDev\LaravelMoodle\Entities;

use DocasDev\LaravelMoodle\GenericCollection;

class CourseCollection extends GenericCollection
{
    public function __construct(Course ...$courses)
    {
        $this->items = $courses;
    }

    public function add(Course $item)
    {
        $this->items[$item->id] = $item;
    }

    public function remove(Course $course)
    {
        if (array_key_exists($course->id, $this->items)) {
            unset($this->items[$course->id]);
        }
    }

    public function removeById(int $courseId)
    {
        if (array_key_exists($courseId, $this->items)) {
            unset($this->items[$courseId]);
        }
    }
}
