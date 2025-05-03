<?php

namespace Aesis\PermissionModelAttributes\Contracts;

interface PermissionAttributes
{
    public static function isReadableStatic(): bool;

    public static function isCreatableStatic(): bool;

    public static function isUpdatableStatic(): bool;

    public static function isDeletableStatic(): bool;

    public function isUpdatable(): bool;

    public function isDeletable(): bool;
}
