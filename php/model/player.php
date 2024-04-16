<?php

require_once dirname(__FILE__, 2) . "/require_utilities.php";
require_path("php/session_manager.php");
require_path("php/php_utilities.php");

// PDO
require_path("php/model/pdo_object.php");
require_path("php/pdo/pdo_utilities.php");

class Player extends PDO_Object
{
    protected const TABLE = "joueurs";
    private const SESSION_TAG = "player";

    const PATH_PFP = "images/pfp/";

    public const ID = "idJoueur";
    #[PDO_Object_Id(Player::ID)]
    public int $Id = -1;

    public const ALIAS = "alias";
    #[PDO_Object_Id(Player::ALIAS)]
    public string $Alias = "";

    public const FIRST_NAME = "prenom";
    #[PDO_Object_Id(Player::FIRST_NAME)]
    public string $FirstName = "";

    public const LAST_NAME = "nom";
    #[PDO_Object_Id(Player::LAST_NAME)]
    public string $LastName = "";

    public const AVATAR = "avatar";
    #[PDO_Object_Id(Player::AVATAR)]
    public string $Avatar = "";

    public const BALANCE = "solde";
    #[PDO_Object_Id(Player::BALANCE)]
    public int $Balance = 0;

    public const ECU_BY_ADMIN = "soldeParAdmin";
    #[PDO_Object_Id(Player::ECU_BY_ADMIN)]
    public int $EcuByAdmin = 0;

    public const ALCHEMY_LEVEL = "niveauAlchimie";
    #[PDO_Object_Id(Player::ALCHEMY_LEVEL)]
    public int $AlchemyLevel = 0;

    public const IS_ADMIN = "estAdmin";
    #[PDO_Object_Id(Player::IS_ADMIN)]
    public bool $IsAdmin = false;

    public const QUEST_ALCHIMIST = "nbQueteAlchimie";
    #[PDO_Object_Id(Player::QUEST_ALCHIMIST)]
    public int $AlchemyQuestNumber = 0;

    public const QUEST_SUCCEED = "nbQueteReussie";
    #[PDO_Object_Id(Player::QUEST_SUCCEED)]
    public int $QuestSuccessNumber = 0;

    public const QUEST_FAILED = "nbQueteEchoue";
    #[PDO_Object_Id(Player::QUEST_FAILED)]
    public int $QuestFailureNumber = 0;

    public const POTION_MADE_COUNT = "nbPotionCree";
    #[PDO_Object_Id(Player::POTION_MADE_COUNT)]
    public int $PotionMadeNumber = -1;

    public const ECU_OBTAINED = "nbEcuGagne";
    #[PDO_Object_Id(Player::ECU_OBTAINED)]
    public int $EcuObtainedNumber = -1;

    public const ECU_SPENT = "nbEcuDepense";
    #[PDO_Object_Id(Player::ECU_SPENT)]
    public int $EcuSpentNumber = -1;

    public const PASSWORD = "motDePasse";
    #[PDO_Object_Id(Player::PASSWORD)]
    public string $Password = "";

    /**
     * @author @WarperSan
     * Date of creation    : 2024/04/09
     * Date of modification: 2024/04/09
     * @return string The fullname of this player
     */
    public function getFullname(): string
    {
        $firstName = $this->FirstName;
        $lastName = $this->LastName;

        if (strlen($firstName) + strlen($lastName) == 0)
            return $this->Alias;

        return $firstName . " " . $lastName;
    }

    /**
     * @author @WarperSan
     * Date of creation    : 2024/04/10
     * Date of modification: 2024/04/10
     * @return string The avatar of this player
     */
    function getAvatar(): string
    {
        return Player::PATH_PFP . $this->Avatar;
    }

    /**
     * @author @WarperSan
     * Date of creation    : 2024/03/26
     * Date of modification: 2024/03/26
     * @return Player|bool The connected player or false if no player is connected
     */
    public static function getLocalPlayer(): Player|bool
    {
        if (!isset($_SESSION[Player::SESSION_TAG]) || !is_connected())
            return false;

        return unserialize($_SESSION[Player::SESSION_TAG]);
    }

    /**
     * Updates the player stored in $_SESSION with the player with the given alias
     * @author @WarperSan, @lolo2178
     * Date of creation    : 2024/03/26
     * Date of modification: 2024/04/09
     * @return bool The refreshment was correctly happen
     */
    public static function refreshLocalPlayer(string $alias = null): bool
    {
        // Default value
        $player = false;

        if ($alias == null) {
            $player = Player::getLocalPlayer();

            if ($player != false)
                $alias = $player->Alias;
        }

        $player = Player::selectComplete(equals(Player::ALIAS, $alias));

        if ($player == false)
            return false;

        $_SESSION[Player::SESSION_TAG] = serialize($player);
        return true;
    }

    #region PDO Functions

    /**
     * Buys the cart of this player
     * @author @WarperSan
     * Date of creation    : 2024/04/09
     * Date of modification: 2024/04/09
     */
    public function buy_cart(): void
    {
        callProcedure("acheterPanier", $this->Id);
    }

    /**
     * Empties the cart of this player
     * @author @WarperSan
     * Date of creation    : 2024/04/09
     * Date of modification: 2024/04/09
     */
    public function empty_cart(): void
    {
        callProcedure("viderPanier", $this->Id);
    }

    #endregion
}