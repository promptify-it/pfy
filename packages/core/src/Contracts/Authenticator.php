<?php

namespace Pfy\Core\Contracts;

use Pfy\Core\Data\UserData;

interface Authenticator
{
    /**
     * Authenticate the user.
     */
    public function authenticate(string $token): bool;

    /**
     * Get the authenticated user.
     */
    public function user(): UserData;

    /**
     * Log the user out.
     */
    public function logout(): void;

    /**
     * Check if the user is authenticated.
     */
    public function check(): bool;
}
