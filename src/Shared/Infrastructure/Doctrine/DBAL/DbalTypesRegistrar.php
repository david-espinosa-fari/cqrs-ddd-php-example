<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Doctrine\DBAL;

use CodelyTv\Mooc\Student\Infrastructure\Persistence\StudentIdType;
use CodelyTv\Mooc\Video\Infrastructure\Persistence\VideoIdType;
use CodelyTv\Shared\Infrastructure\Persistence\Course\CourseIdType;
use Doctrine\DBAL\Types\Type;
use function Lambdish\Phunctional\each;

final class DbalTypesRegistrar
{
    private static $initialized = false;
    private static $types = [
        CourseIdType::NAME  => CourseIdType::class,
        StudentIdType::NAME => StudentIdType::class,
        VideoIdType::NAME   => VideoIdType::class,
    ];

    public static function register(): void
    {
        if (!self::$initialized) {
            each(self::registerType(), self::$types);

            self::$initialized = true;
        }
    }

    private static function registerType(): callable
    {
        return function ($class, $name): void {
            Type::addType($name, $class);
        };
    }
}
