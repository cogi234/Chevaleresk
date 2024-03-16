<?php

require_once "php/pdo.php";

/**
 * Class that allows to fetch objects from the DB more easily
 * @author @WarperSan
 * Date of creation    : 2024/03/16
 * Date of modification: 2024/03/16
 */
abstract class PDO_Object
{
    // --- EXAMPLE ---
    // public const IDENTIFIER = "db_name";
    // #[PDO_Object_Id( TYPE::IDENTIFIER )]
    // public mixed $Var = DEFAULT_VALUE;
    // ---

    public function __construct(mixed $data)
    {
        // TODO: Make it so that you just need the attribute without the constant (Item::$Nom instead of Item::NAME)
        // Get properties
        $class = new ReflectionClass(get_called_class());

        foreach ($class->getProperties() as $key => $prop) {
            $attributes = $prop->getAttributes(PDO_Object_Id::class);

            if (count($attributes) < 1)
                continue;

            // Get infos
            $identifier = $attributes[0]->getArguments()[0];
            $default = $prop->getDefaultValue();

            isset_default($data[$identifier], $default);

            // Set value
            $value = $data[$identifier];
            settype($value, $prop->getType()->getName());

            $name = $prop->getName();
            $this->$name = $value;
        }
    }

    /**
     * Fetches every result of the given select request with the given parameters
     * @author @WarperSan
     * Date of creation    : 2024/03/16
     * Date of modification: 2024/03/16
     */
    public static function selectAll(
        array $selectors,
        string $condition = "",
        string $other = ""
    ): array {

        $className = get_called_class();
        $table = "$className::TABLE";

        if (!defined($table))
            return [];

        $items = selectAll(
            join(", ", $selectors),
            constant($table),
            $condition,
            $other
        );

        $parsed_items = [];

        for ($i = 0; $i < count($items); $i++)
            array_push($parsed_items, new $className($items[$i]));

        return $parsed_items;
    }
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