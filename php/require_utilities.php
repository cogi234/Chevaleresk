<?php

function require_path(string $path): void
{
    require_once dirname(__FILE__, 2) . "/" . $path;
}