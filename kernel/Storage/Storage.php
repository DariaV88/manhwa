<?php

namespace App\Kernel\Storage;

use App\Kernel\Config\ConfigInterface;

class Storage implements StorageInterface
{
    public function __construct(
        private ConfigInterface $config,
    ) {
    }

    public function url(string $path): string
    {

        return "http://manhwa/storage/$path";
    }

    public function get(string $path): string
    {
        return file_get_contents($this->storagePath($path));
    }

    private function storagePath(string $path): string
    {
        return APP_PATH."/storage/$path";
    }
}