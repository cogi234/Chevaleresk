<?php

$DB_CONNECTION = connect();

/**
 * Creates a connection to the database
 * @author @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/14
 */
function connect(): PDO
{
    if (isset($DB_CONNECTION))
        $DB_CONNECTION = null;

    return new PDO('mysql:host=167.114.152.54;dbname=dbchevalersk9;charset=utf8', 'chevalier9', 's748jcs2');
}

/**
 * Creates a request to the database with the given parameters
 * @author @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/14
 */
function query(
    string $selectors,
    string $table,
    string $condition = ""
): bool|PDOStatement {
    if (!isset($DB_CONNECTION))
        $DB_CONNECTION = connect();

    if (strlen(trim($condition)) != 0)
        $condition = "WHERE " . $condition;

    return $DB_CONNECTION->query("SELECT $selectors FROM $table $condition");
}

/**
 * Executes a select request with the given parameters
 * @author @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/14
 */
function select(
    string $selectors,
    string $table,
    string $condition = ""
): mixed {
    return query($selectors, $table, $condition)->fetch();
}

/**
 * Executes a select request with the given parameters
 * @author @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/14
 */
function selectAll(
    string $selectors,
    string $table,
    string $condition = ""
): array {
    return query($selectors, $table, $condition)->fetchAll();
}