<?php

namespace DocasDev\LaravelMoodle\Entities\DTO;

use DocasDev\LaravelMoodle\Shared\StaticCreateSelf;
use DocasDev\LaravelMoodle\Shared\ToArray;

class CourseDTO
{
    use StaticCreateSelf;
    use ToArray;

    public string $fullName;

    public string $shortName;

    public int $categoryId;

    public int $idNumber;

    public string $summary;

    public int $summaryFormat;

    public string $format;

    public int $showGrades;

    public int $newsItems;

    public int $startDate;

    public int $endDate;

    public int $numSections;

    public int $maxBytes;

    public int $showReports;

    public int $visible;

    public int $hiddensections;

    public int $groupMode;

    public int $groupModeForce;

    public int $defaultGroupingId;

    public int $enableCompletion;

    public int $completionNotify;

    public string $lang;

    public string $forceTheme;

    public array $courseFormatOptions = [];

    public array $customfields = [];
}
