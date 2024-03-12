<?php

/**
 * Sets the variable to the given value if the variable is not set
 * @author @WarperSan
 * Date of creation    : 2024/03/10
 * Date of modification: 2024/03/11
 */
function isset_default(mixed &$var, mixed $defaultValue = ""): void
{
    if (isset($var))
        return;

    $var = $defaultValue;
}

/**
 * Fetches the content of the given file
 * @author @WarperSan
 * Date of creation    : 2024/03/10
 * Date of modification: 2024/03/11
 */
function getContentOrDefault(string $path, mixed $defaultValue = ""): string
{
    return file_exists($path) ? file_get_contents($path) : $defaultValue;
}