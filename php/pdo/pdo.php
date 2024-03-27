<?php

require_once "php/php_utilities.php";

$DB_CONNECTION = connect();

/**
 * Creates a connection to the database
 * @author @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/16
 * @return PDO Current connection to the database
 */
function connect(): PDO
{
    // Create the connection if not set
    isset_default($DB_CONNECTION, new PDO('mysql:host=167.114.152.54;dbname=dbchevalersk9;charset=utf8', 'chevalier9', 's748jcs2'));

    return $DB_CONNECTION;
}

/**
 * Creates a request to the database with the given parameters
 * @author @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/18
 * @return bool|PDOStatement An PDOStatement instance or false if an error occured
 */
function query(
    string $selectors,
    string $table,
    string $condition = "",
    string $other = ""
): bool|PDOStatement {
    // Create the where clause
    if (strlen(trim($condition)) != 0)
        $condition = "WHERE " . $condition;

    return connect()->query("SELECT $selectors FROM $table $condition $other");
}

/**
 * Fetches the first result of the given select request with the given parameters
 * @author @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/18
 * @return array|bool Result of the request or false if an error occured
 */
function select(
    string $selectors,
    string $table,
    string $condition = "",
    string $other = ""
): array|bool {
    $result = query($selectors, $table, $condition, $other);

    if ($result == false)
        return false;

    return $result->fetch(PDO::FETCH_ASSOC);
}

/**
 * Fetches every result of the given select request with the given parameters
 * @author @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/18
 * @return array|bool Results of the request or false if an error occured
 */
function selectAll(
    string $selectors,
    string $table,
    string $condition = "",
    string $other = ""
): array|bool {
    $result = query($selectors, $table, $condition, $other);

    if ($result == false)
        return false;

    return $result->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Executes the given action with the given parameters
 * @author @Colin_Bougie, @WarperSan
 * Date of creation    : 2024/03/16
 * Date of modification: 2024/03/18
 * @return bool|PDOStatement Statement of the request or false if an error occured
 */
function callFP(string $action_name, string $procedure_name, array $arguments): bool|PDOStatement
{

    if (!isset ($DB_CONNECTION))
        $DB_CONNECTION = connect();

    // We build the query "action name(?,?,?)"
    $query = "$action_name $procedure_name(";

    for ($i = 0; $i < count($arguments); $i++) {
        if ($i != 0)
            $query .= ",";
        $query .= "?";
    }
    $query .= ")";

    // Prepare statement
    $statement = $DB_CONNECTION->prepare($query);
    if (!$statement)
        return false;

    for ($i = 0; $i < count($arguments); $i++)
        $statement->bindValue($i + 1, $arguments[$i]);

    return $statement;
}

/**
 * Executes a procedure with the given parameters
 * @author @Colin_Bougie, @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/18
 * @return bool True if it was a success, False on failure
 */
function callProcedure(string $procedure_name, ...$arguments): bool
{
    $result = callFP("CALL", $procedure_name, $arguments);

    return $result && $result->execute();
}

/**
 * Executes a function with the given parameters
 * @author @Colin_Bougie, @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/18
 * @return array|bool Results of the call or false if an error occured
 */
function callFunction(string $function_name, ...$arguments): array|bool
{
    $result = callFP("SELECT", $function_name, $arguments);

    return $result && $result->execute()
        ? $result->fetchAll()
        : false;
}