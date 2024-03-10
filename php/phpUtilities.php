<?php

/**
 * Sets the variable to the given value if the variable is not set
 * @author @WarperSan
 * Date of creation    : 2024/03/10
 * Date of modification: 2024/03/10
 */
function isset_default(&$var, $defaultValue = ""): void
{
    if (isset($var))
        return;

    $var = $defaultValue;
}

/**
 * Fetches the content of the given file
 * @author @WarperSan
 * Date of creation    : 2024/03/10
 * Date of modification: 2024/03/10
 */
function getContentOrDefault($path, $defaultValue = ""): string
{
    return file_exists($path) ? file_get_contents($path) : $defaultValue;
}