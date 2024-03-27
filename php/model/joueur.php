<?php
require_once "php/sessionManager.php";
require_once "php/phpUtilities.php";

// PDO
require_once "php/pdo_object.php";
require_once "php/pdoUtilities.php";

class Joueur extends PDO_Object
{
    protected const TABLE = "joueurs";
    private const SESSION_TAG = "joueur";

    const PATH_PFP = "images/pfp/images/";

    public const ID = "idJoueur";
    #[PDO_Object_Id(Joueur::ID)]
    public int $Id = -1;

    public const ALIAS = "alias";
    #[PDO_Object_Id(Joueur::ALIAS)]
    public string $alias = "";

    public const PRENOM = "prenom";
    #[PDO_Object_Id(Joueur::PRENOM)]
    public string $prenom = "";

    public const NOM = "nom";
    #[PDO_Object_Id(Joueur::NOM)]
    public string $nom = "";

    public const AVATAR = "avatar";
    #[PDO_Object_Id(Joueur::AVATAR)]
    public string $avatar = "";

    public const SOLDE = "solde";
    #[PDO_Object_Id(Joueur::SOLDE)]
    public int $solde = 0;

    public const ECU_BY_ADMIN = "soldeParAdmin";
    #[PDO_Object_Id(Joueur::ECU_BY_ADMIN)]
    public int $soldeParAdmin = 0;

    public const LEVEL_ALCHIMIST = "niveauAlchimie";
    #[PDO_Object_Id(Joueur::LEVEL_ALCHIMIST)]
    public int $niveauAlchimie = 0;

    public const IS_ADMIN = "estAdmin";
    #[PDO_Object_Id(Joueur::IS_ADMIN)]
    public bool $estAdmin = false;

    public const QUEST_ALCHIMIST = "nbQueteAlchimie";
    #[PDO_Object_Id(Joueur::QUEST_ALCHIMIST)]
    public int $nbQueteAlchimie = 0;

    public const QUEST_SUCCEED = "nbQueteReussie";
    #[PDO_Object_Id(Joueur::QUEST_SUCCEED)]
    public int $nbQueteReussie = 0;

    public const QUEST_FAILED = "nbQueteEchoue";
    #[PDO_Object_Id(Joueur::QUEST_FAILED)]
    public int $nbQueteEchoue = 0;

    public const POTION_MADE_COUNT = "nbPotionCree";
    #[PDO_Object_Id(Joueur::POTION_MADE_COUNT)]
    public int $nbPotionCree = -1;

    public const ECU_OBTAINED = "nbEcuGagne";
    #[PDO_Object_Id(Joueur::ECU_OBTAINED)]
    public int $nbEcuGagne = -1;

    public const ECU_SPENT = "nbEcuDepense";
    #[PDO_Object_Id(Joueur::ECU_SPENT)]
    public int $nbEcuDepense = -1;

    public const PASSWORD = "motDePasse";
    #[PDO_Object_Id(Joueur::PASSWORD)]
    public string $motDePasse = "";

    /**
     * @author @WarperSan
     * Date of creation    : 2024/03/26
     * Date of modification: 2024/03/26
     * @return Joueur|bool The connected player or false if no player is connected
     */
    public static function get_local_player(): Joueur|bool
    {
        if (!isset($_SESSION[Joueur::SESSION_TAG]) || !is_connected())
            return false;

        return unserialize($_SESSION[Joueur::SESSION_TAG]);
    }

    /**
     * Updates the player stored in $_SESSION with the player with the given alias
     * @author @WarperSan, @lolo2178
     * Date of creation    : 2024/03/26
     * Date of modification: 2024/03/26
     * @return bool The refreshment was correctly happen
     */
    public static function refresh_local_player(string $alias): bool
    {
        $player = Joueur::select([
            Joueur::ID,
            Joueur::ALIAS,
            Joueur::PASSWORD,
            Joueur::PRENOM,
            Joueur::NOM,
            Joueur::AVATAR,
            Joueur::SOLDE,
            //Joueur::ECU_BY_ADMIN,
            //Joueur::LEVEL_ALCHIMIST,
            Joueur::IS_ADMIN
            //Joueur::QUEST_ALCHIMIST,
            //Joueur::QUEST_SUCCEED,
            //Joueur::QUEST_FAILED,
            //Joueur::POTION_MADE_COUNT,
            //Joueur::ECU_OBTAINED,
            //Joueur::ECU_SPENT
        ], equals(Joueur::ALIAS, $alias));

        if ($player == false)
            return false;

        $_SESSION[Joueur::SESSION_TAG] = serialize($player);
        return true;
    }
}