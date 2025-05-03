<?php

namespace Aesis\PermissionModelAttributes\Traits;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

trait HasPermissionAttributes
{
    public static function bootHasPermissionAttributes()
    {
        if (!is_subclass_of(static::class, Model::class)) {
            throw new \Exception('The HasPermissionAttributes trait can only be applied to Eloquent models.');
        }
    }

    public static function isCreatableStatic(): bool
    {
        return checkModelAction(static::class, 'create');
    }

    public static function isReadableStatic(): bool
    {
        return checkModelAction(static::class, 'read');
    }

    public static function isUpdatableStatic(): bool
    {
        return checkModelAction(static::class, 'update');
    }

    public static function isDeletableStatic(): bool
    {
        return checkModelAction(static::class, 'delete');
    }

    public function isUpdatable()
    {
        return checkModelAction($this, 'update');
    }

    public function isDeletable()
    {
        return checkModelAction($this, 'delete');
    }

    public function updatable(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->isUpdatable(),
        )->shouldCache();
    }

    public function deletable(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->isDeletable(),
        )->shouldCache();
    }
}
