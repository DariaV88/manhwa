<?php

namespace App\Kernel\Auth;

interface AuthInterface
{
    public function attempt(string $username, string $password): bool;

    public function check(): bool;

    public function user();

    public function logout(): void;

    public function table(): string;

    public function name(): string;

    public function password(): string;

    public function email(): string;

    public function sessionField(): string;

    public function id(): ?int;

}