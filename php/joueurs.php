<?php
require_once "php/sessionManager.php";
require_once "php/phpUtilities.php";
require_once "php/pdo_object.php";

function updateJoueur(string $alias)
{
    $player = Joueur::select([
        Joueur::ID,
        Joueur::ALIAS,
        Joueur::PRENOM,
        Joueur::NOM,
        Joueur::AVATAR,
        Joueur::SOLDE,
        Joueur::SOLDEPARADMIN,
        Joueur::NIVEAUALCHIMIE,
        Joueur::ESTADMIN,
        Joueur::NBQUETEALCHIMIE,
        Joueur::NBQUETEREUSSIE,
        Joueur::NBQUETEECHOUE,
        Joueur::NBPOTIONCREE,
        Joueur::NBECUGAGNE,
        Joueur::NBECUDEPENSE,
        Joueur::MOTDEPASSE
    ], Joueur::ALIAS . " = '$alias' ");
    $_SESSION['joueur'] = serialize($player);
}

class Joueur extends PDO_Object
{
    protected const TABLE = "joueurs";

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

    public const SOLDEPARADMIN = "soldeParAdmin";
    #[PDO_Object_Id(Joueur::SOLDEPARADMIN)]
    public int $soldeParAdmin = 0;

    public const NIVEAUALCHIMIE = "niveauAlchimie";
    #[PDO_Object_Id(Joueur::NIVEAUALCHIMIE)]
    public int $niveauAlchimie = 0;

    public const ESTADMIN = "estAdmin";
    #[PDO_Object_Id(Joueur::ESTADMIN)]
    public bool $estAdmin = false;

    public const NBQUETEALCHIMIE = "nbQueteAlchimie";
    #[PDO_Object_Id(Joueur::NBQUETEALCHIMIE)]
    public int $nbQueteAlchimie = 0;

    public const NBQUETEREUSSIE = "nbQueteReussie";
    #[PDO_Object_Id(Joueur::NBQUETEREUSSIE)]
    public int $nbQueteReussie = 0;

    public const NBQUETEECHOUE = "nbQueteEchoue";
    #[PDO_Object_Id(Joueur::NBQUETEECHOUE)]
    public int $nbQueteEchoue = 0;

    public const NBPOTIONCREE = "nbPotionCree";
    #[PDO_Object_Id(Joueur::NBPOTIONCREE)]
    public int $nbPotionCree = 0;

    public const NBECUGAGNE = "nbEcuGagne";
    #[PDO_Object_Id(Joueur::NBECUGAGNE)]
    public int $nbEcuGagne = 0;

    public const NBECUDEPENSE = "nbEcuDepense";
    #[PDO_Object_Id(Joueur::NBECUDEPENSE)]
    public int $nbEcuDepense = 0;

    public const MOTDEPASSE = "motDePasse";
    #[PDO_Object_Id(Joueur::MOTDEPASSE)]
    public string $motDePasse = "";

}