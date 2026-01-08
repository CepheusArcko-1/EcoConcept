<?php
/**
 * Gestionnaire de la classe User
 */
class UserDao {
    
    /** Instance PDO pour la connexion à la base */
    private $_db;
    
    /**
     * Constructeur : reçoit la connexion PDO
     */
    public function __construct($db) {
        $this->setDb($db);
    }
     
    /**
     * Vérifie si un utilisateur existe avec un couple identifiant / mot de passe
     * Utilisé lors de la connexion
     */
    public function userExist($userId, $userPwd) {

        $req = "SELECT userId FROM user WHERE userId = ? AND userPwd = ?";
        $stmt = $this->_db->prepare($req);
        $stmt->execute([$userId, $userPwd]);

        return $stmt->fetch() !== false;
    }
    
    /**
     * Vérifie si un identifiant existe déjà
     * Utilisé lors de l'inscription
     */
    public function idExist($userId) {

        $req = "SELECT userId FROM user WHERE userId = ?";
        $stmt = $this->_db->prepare($req);
        $stmt->execute([$userId]);

        return $stmt->fetch() !== false;
    }
    
    /**
     * Récupère la liste de tous les utilisateurs
     */
    public function getList() {

        $users = [];
        $compteur = 0;

        $rqt = $this->_db->prepare("SELECT * FROM user");
        $rqt->execute();
    
        while ($donnees = $rqt->fetch()) {
            $users[$compteur] = new User($donnees);
            $compteur++;
        }

        return $users;
    }
     
    /**
     * Ajoute un nouvel utilisateur dans la base
     * Le mot de passe doit être déjà hashé AVANT l'appel
     */
    public function add($user) {

        $rqt = $this->_db->prepare("INSERT INTO user(userId, userPwd) VALUES(?, ?)");
        $rqt->bindValue(1, $user->getUserId());
        $rqt->bindValue(2, $user->getUserPwd());

        return $rqt->execute();
    }
  
    /**
     * Setter de la connexion PDO
     */
    public function setDb(PDO $db) {
        $this->_db = $db;
    }
}
