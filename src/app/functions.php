<?php

declare(strict_types=1);

function getSessionMessage(): string
{
    $message = '';
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }

    return $message;
}

function getErrorMessage(string $field): string
{
    $message = '';
    if (isset($_SESSION['errors'][$field])) {
        $message = $_SESSION['errors'][$field];
        unset($_SESSION['errors'][$field]);
    }

    return $message;
}

function getField(string $field): string
{
    $value = '';
    if (isset($_SESSION['fields'][$field])) {
        $value = $_SESSION['fields'][$field];
        unset($_SESSION['fields'][$field]);
    }

    return $value;
}

function isUserLoggedIn(): bool
{
    return isset($_SESSION['user']);
}
