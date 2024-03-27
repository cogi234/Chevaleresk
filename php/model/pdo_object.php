<?php

require_once dirname(dirname(__FILE__)) . "/require_utilities.php";
require_path("php/pdo/pdo.php");

/**
 * Class that allows to fetch objects from the database more easily
 */
abstract class PDO_Object
{
    // --- EXAMPLE ---
    // public const IDENTIFIER = "db_name";
    // #[PDO_Object_Id( TYPE::IDENTIFIER )]
    // public mixed $Var = DEFAULT_VALUE;
    // ---

    #region Public

    public function __construct(array $data)
    {
        $this->set_values($data);
    }

    public const ALL = ["*"];

    #endregion

    #region Private

    /**
     * Initializes every given parameter to the given value
     * @author @WarperSan
     * Date of creation    : 2024/03/18
     * Date of modification: 2024/03/18
     */
    private function set_values(array $data): void
    {
        // TODO: Make it so that you just need the attribute without the constant (Item::$Nom instead of Item::NAME)

        // Get properties
        $class = new ReflectionClass($this::class);

        foreach ($class->getProperties() as $key => $prop) {
            $attributes = $prop->getAttributes(PDO_Object_Id::class);

            if (count($attributes) < 1)
                continue;

            // Get infos
            $identifier = $attributes[0]->getArguments()[0];

            // If not set
            if (!isset($data[$identifier]))
                continue;

            // Set value
            $value = $data[$identifier];
            settype($value, $prop->getType()->getName());

            $name = $prop->getName();
            $this->$name = $value;
        }
    }

    #endregion

    #region Public Static

    /**
     * Fetches every result of the given select request with the given parameters
     * @author @WarperSan
     * Date of creation    : 2024/03/16
     * Date of modification: 2024/03/18
     */
    public static function selectAll(
        array $selectors,
        string $condition = "",
        string $other = ""
    ): array {
        $tableName = static::get_table_name();

        if ($tableName == false)
            return [];

        $items = selectAll(
            join(", ", $selectors),
            $tableName,
            $condition,
            $other
        );

        return array_map(function ($value) {
            return static::create_self($value);
        }, $items);
    }

    public static function select(
        array $selectors,
        string $condition = "",
        string $other = ""
    ): PDO_Object|bool {
        $tableName = static::get_table_name();

        if ($tableName == false)
            return false;

        $item = select(join(", ", $selectors), $tableName, $condition, $other);

        if ($item == false)
            return false;

        return static::create_self($item);
    }

    /**
     * @author @WarperSan
     * Date of creation    : 2024/03/18
     * Date of modification: 2024/03/18
     * @return object New instance of this object with the given data
     */
    public static function create_self(array $data, string $class = null): object
    {
        $class ??= static::class;

        return new $class($data);
    }

    #endregion

    #region Private Static

    /**
     * @author @WarperSan
     * Date of creation    : 2024/03/18
     * Date of modification: 2024/03/18
     * @return string|bool Name of the table of the given object. If not found, returns false
     */
    private static function get_table_name(string $class = null): string|bool
    {
        $class ??= static::class;
        $table = "$class::TABLE";

        return defined($table) ? constant($table) : false;
    }

    #endregion
}

#[Attribute]
class PDO_Object_Id
{
    public string $id;
    public function __construct(string $id)
    {
        $this->id = $id;
    }
}