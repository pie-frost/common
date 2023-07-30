<?php
declare(strict_types=1);
namespace PIEFrost\Common\Cache;

use PIEFrost\Common\Model;

class ModelCache
{
    /** @var array<string, array<string, Model>> */
    private array $cache = [];

    public function getModel(string $model, string $namespace): ?Model
    {
        if (!array_key_exists($namespace, $this->cache)) {
            return null;
        }
        return $this->cache[$namespace][$model] ?? null;
    }

    public function storeModel(string $model, string $namespace, Model $object): void
    {
        if (!array_key_exists($namespace, $this->cache)) {
            $this->cache[$namespace] = [];
        }
        $this->cache[$namespace][$model] = $object;
    }
}
