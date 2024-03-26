<?php

require_once "phpUtilities.php";

/**
 * @author @WarperSan
 * Date of creation    : 2024/03/20
 * Date of modification: 2024/03/20
 * @return string Given value written for a query 
 */
function convert_for_query(mixed $value): string
{
    if (is_string($value))
        return "'$value'";

    return strval($value);
}

#region Where

/**
 * @author @WarperSan
 * Date of creation    : 2024/03/20
 * Date of modification: 2024/03/20
 * @return string AND combination of every given argument 
 */
function _and(...$others): string
{
    // Skips all verifications if the result will always be false
    if (in_array("false", $others))
        return "false";

    return join(" AND ", $others);
}

/**
 * @author @WarperSan
 * Date of creation    : 2024/03/20
 * Date of modification: 2024/03/20
 * @return string OR combination of every given argument 
 */
function _or(...$others): string
{
    // Skips all verifications if the result will always be true
    if (in_array("true", $others))
        return "true";

    return join(" OR ", $others);
}

/**
 * @author @WarperSan
 * Date of creation    : 2024/03/20
 * Date of modification: 2024/03/20
 * @return string Equals statement 
 */
function equals(string $column, mixed $target): string
{
    return "$column = " . convert_for_query($target);
}

/**
 * @author @WarperSan
 * Date of creation    : 2024/03/20
 * Date of modification: 2024/03/20
 * @return string In statement 
 */
function in(string $column, ...$array): string
{
    if (count($array) == 0)
        return "false";

    $query = "";

    for ($i = 0; $i < count($array); $i++) {
        if ($i != 0)
            $query .= ", ";

        $query .= convert_for_query($array[$i]);
    }

    return "$column IN($query)";
}

#endregion

#region Other

/**
 * @author @WarperSan
 * Date of creation    : 2024/03/20
 * Date of modification: 2024/03/20
 * @return string Combination of every given argument 
 */
function combine(...$others): string
{
    return join(" ", $others);
}

/**
 * @author @WarperSan
 * Date of creation    : 2024/03/20
 * Date of modification: 2024/03/20
 * @return string Order statement 
 */
function orderBy(string $column, bool $isAsc = true): string
{
    return orderByAll([
        $column,
        $isAsc
    ]);
}

/**
 * Creates an order statement with the given parameters. Each element is an array: [ string name_of_the_column, bool is_asc ]
 * @author @WarperSan
 * Date of creation    : 2024/03/20
 * Date of modification: 2024/03/20
 * @return string Order statement for all the given parameters 
 */
function orderByAll(...$conditions): string
{
    $query = "";

    for ($i = 0; $i < count($conditions); $i++) {
        $condition = $conditions[$i];

        // If the column is not set, skip
        if (!isset ($condition[0]))
            continue;

        // Add separator
        if ($i != 0)
            $query .= ", ";

        // Set the value to true by default
        isset_default($condition[1], true);

        // Get values
        $column = $condition[0];
        $direction = $condition[1];

        // Add order statement
        $query .= $column . " " . ($direction ? "ASC" : "DESC");
    }

    return "ORDER BY $query";
}

/**
 * @author @WarperSan
 * Date of creation    : 2024/03/20
 * Date of modification: 2024/03/20
 * @return string Limit statement 
 */
function limit(int $length, int $start = 0): string
{
    return "LIMIT $start, $length";
}

#endregion