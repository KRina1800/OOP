<?php

class CacheManager {
    private static $instance;
    private $cache = [];

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new CacheManager();
        }
        return self::$instance;
    }

    public function set($key, $value) {
        $this->cache[$key] = $value;
    }

    public function get($key) {
        return $this->cache[$key] ?? null;
    }

    public function delete($key) {
        unset($this->cache[$key]);
    }

    public function clear() {
        $this->cache = [];
    }
}

// Пример использования
$cacheManager1 = CacheManager::getInstance();
$cacheManager1->set('user:1', ['name' => 'John', 'age' => 30]);

$cacheManager2 = CacheManager::getInstance();
$userData = $cacheManager2->get('user:1');
var_dump($userData); // Должно вывести данные пользователя

$cacheManager1->delete('user:1'); // Удаление данных из кэша

$cacheManager2->clear(); // Очистка всего кэша