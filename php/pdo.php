<?php

require_once "php/phpUtilities.php";

/**
 * Class that allows to fetch objects from the DB more easily
 * @author @WarperSan
 * Date of creation    : 2024/03/16
 * Date of modification: 2024/03/16
 */
abstract class PDO_Object
{
    protected function getValue(mixed $data, string $identifier, mixed $defaultValue = ''): string
    {
        isset_default($data[$identifier], $defaultValue);

        return $data[$identifier];
    }

    public static function selectAll(
        array $selectors,
        string $condition = "",
        string $other = ""
    ): array {

        $className = get_called_class();
        $table = "$className::TABLE";

        if (!defined($table))
            return [];

        return selectAll(
            join(", ", $selectors),
            constant($table),
            $condition,
            $other
        );
    }
}

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
    string $condition = "",
    string $other = ""
): bool|PDOStatement {
    if (!isset($DB_CONNECTION))
        $DB_CONNECTION = connect();

    if (strlen(trim($condition)) != 0)
        $condition = "WHERE " . $condition;

    return $DB_CONNECTION->query("SELECT $selectors FROM $table $condition $other");
}

/**
 * Executes a select request with the given parameters
 * @author @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/16
 */
function select(
    string $selectors,
    string $table,
    string $condition = "",
    string $other = ""
): mixed {
    return query($selectors, $table, $condition, $other)->fetch(PDO::FETCH_ASSOC);
}

/**
 * Executes a select request with the given parameters
 * @author @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/16
 */
function selectAll(
    string $selectors,
    string $table,
    string $condition = "",
    string $other = ""
): array {
    return query($selectors, $table, $condition)->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Executes the given action with the given parameters
 * @author @WarperSan
 * Date of creation    : 2024/03/16
 * Date of modification: 2024/03/16
 */
function callFP(string $action_name, string $procedure_name, ...$arguments): bool|PDOStatement
{
    if (!isset($DB_CONNECTION))
        $DB_CONNECTION = connect();

    // We build the query
    $args = join(",?", $arguments) . "?";
    $query = "$action_name $procedure_name($args)";

    // TODO: Test if this new way also works
    // for ($i = 0; $i < count($arguments); $i++) {
    //     if ($i != 0)
    //         $query .= ",";
    //     $query .= "?";
    // }
    // $query .= ")";

    // Prepare statement
    $statement = $DB_CONNECTION->prepare($query);
    if ($statement == false)
        return false;

    for ($i = 0; $i < count($arguments); $i++)
        $statement->bindValue($i + 1, $arguments[$i]);

    return $statement;
}

/**
 * Executes a procedure with the given parameters
 * @author @Colin_Bougie, @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/16
 * @return bool True if it was a success, False on failure
 */
function callProcedure(string $procedure_name, ...$arguments): bool
{
    $result = callFP("CALL", $procedure_name, $arguments);

    if ($result == false)
        return false;
    return $result->execute();
}

/**
 * Executes a function with the given parameters
 * @author @Colin_Bougie, @WarperSan
 * Date of creation    : 2024/03/14
 * Date of modification: 2024/03/16
 */
function callFunction(string $function_name, ...$arguments): array
{
    $result = callFP("SELECT", $function_name, $arguments);

    if ($result == false || !$result->execute())
        return [];

    return $result->fetchAll();
}