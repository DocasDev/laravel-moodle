<?php

namespace DocasDev\LaravelMoodle\Shared;

enum CourseFormat
{
    case Singleactivity;
    case Social;
    case Topics;
    case Weeks;

    public function toString()
    {
        return match($this)
        {
            CourseFormat::Singleactivity => 'singleactivity',
            CourseFormat::Social => 'social',
            CourseFormat::Topics => 'topics',
            CourseFormat::Weeks => 'weeks'
        };
    }
}
