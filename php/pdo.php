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

/**
 * Executes a procedure with the given parameters
 * @author @Colin_Bougie
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/14
 * @return bool True if it was a success, False on failure
 */
function callProcedure(string $procedure_name, ...$arguments) : bool{
    if (!isset($DB_CONNECTION))
        $DB_CONNECTION = connect();
    // We build the query
    $query = "CALL " . $procedure_name . "(";
    for ($i = 0; $i < count($arguments); $i++){
        if ($i != 0)
            $query .= ",";
        $query .= "?";
    }
    $query .= ")";

    // Prepare statement
    $statement = $DB_CONNECTION->prepare($query);
    if ($statement == false)
        return false;

    for ($i = 0; $i < count($arguments); $i++){
        $statement->bindValue($i+1, $arguments[$i]);
    }
    return $statement->execute();
}

function callFunction(string $function_name, ...$arguments) : array {
    if (!isset($DB_CONNECTION))
        $DB_CONNECTION = connect();
    // We build the query
    $query = "SELECT " . $function_name . "(";
    for ($i = 0; $i < count($arguments); $i++){
        if ($i != 0)
            $query .= ",";
        $query .= "?";
    }
    $query .= ")";

    // Prepare statement
    $statement = $DB_CONNECTION->prepare($query);
    if ($statement == false)
        return [];

    for ($i = 0; $i < count($arguments); $i++){
        $statement->bindValue($i+1, $arguments[$i]);
    }

    if ($statement->execute()){
        return $statement->fetchAll();
    } else {
        return [];
    }
}