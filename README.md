# Laravel Permission Model Attributes

[![Latest Version on Packagist](https://img.shields.io/packagist/v/curly-deni/laravel-permission-model-attributes.svg?style=flat-square)](https://packagist.org/packages/curly-deni/laravel-permission-model-attributes)
[![Code Style](https://img.shields.io/github/actions/workflow/status/curly-deni/laravel-permission-model-attributes/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/curly-deni/laravel-permission-model-attributes/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/curly-deni/laravel-permission-model-attributes.svg?style=flat-square)](https://packagist.org/packages/curly-deni/laravel-permission-model-attributes)

**Laravel Permission Model Attributes** adds permission-aware properties to your Eloquent models using native Laravel authorization. It provides a convenient way to check and expose model-level permissions through dynamic attributes like `updatable` and `deletable`, based on policies or internal rules.

---

## ✨ Features

- ✅ Adds `updatable` and `deletable` model attributes
- 🧠 Static permission checks: `create`, `read`, `update`, `delete`
- 🔐 Seamless integration with Laravel’s native authorization system (policies)
- ⚡ Attribute caching for performance
- 🧩 Optional interface for strict typing

---

## 📦 Installation

Install via Composer:

```bash
composer require curly-deni/laravel-permission-model-attributes
````

Publish the config file:

```bash
php artisan vendor:publish --tag="laravel-permission-model-attributes-config"
```

---

## ⚙️ Configuration

```php
return [
    'create' => true,
    'update' => true,
    'delete' => true,
    'read' => false,
];
```

Each flag enables permission checks for the corresponding action:

| Key    | Description                                           |
| ------ | ----------------------------------------------------- |
| create | Enables permission check via `create()` policy method |
| read   | Enables permission check via `read()` policy method   |
| update | Enables permission check via `update()` policy method |
| delete | Enables permission check via `delete()` policy method |

> ✅ Only the enabled actions will be checked. If disabled, permission checks are skipped entirely.

---

## 🛡 Policy Integration

The package automatically uses Laravel’s policy system. You must define policy methods **only for the enabled actions**.

### ✏ Define Policy Methods

```php
class PostPolicy
{
    public function create(User $user)
    {
        return $user->hasPermission('create-posts');
    }

    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function read(User $user)
    {
        return $user->hasPermission('read-posts');
    }
}
```

> ⚠️ **Note:** The `read()` method accepts only the `User` object — **no model instance is passed**.

---

## 🚀 Usage

### 1. Add the Trait

```php
use Aesis\PermissionModelAttributes\Traits\HasPermissionAttributes;

class Post extends Model
{
    use HasPermissionAttributes;
}
```

### 2. (Optional) Implement the Interface

```php
use Aesis\PermissionModelAttributes\Contracts\PermissionAttributes;

class Post extends Model implements PermissionAttributes
{
    use HasPermissionAttributes;
}
```

### 3. Access in Code

```php
$post = Post::find(1);

if ($post->updatable) {
    // show edit button
}

if (Post::isCreatableStatic()) {
    // show "New" button
}
```

---

## 📘 Trait Reference

| Method / Attribute    | Type             | Description                                  |
| --------------------- | ---------------- | -------------------------------------------- |
| `updatable`           | Attribute (bool) | Returns `true` if the model can be updated   |
| `deletable`           | Attribute (bool) | Returns `true` if the model can be deleted   |
| `isUpdatable()`       | Method           | Instance-level permission check for `update` |
| `isDeletable()`       | Method           | Instance-level permission check for `delete` |
| `isCreatableStatic()` | Static           | Class-level permission check for `create`    |
| `isReadableStatic()`  | Static           | Class-level permission check for `read`      |
| `isUpdatableStatic()` | Static           | Class-level permission check for `update`    |
| `isDeletableStatic()` | Static           | Class-level permission check for `delete`    |

---

## 👤 Author

* [Danila Mikhalev](https://github.com/curly-deni)

---

## 📝 License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).

