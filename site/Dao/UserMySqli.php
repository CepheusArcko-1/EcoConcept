<?php
/**
 * Gestionnaire de la classe user (version MySQLi vulnérable)
 */
class userDao {
    
    /** Instance MySQLi pour se connecter à la BD */
    private $_db;
    
    /**
     * Connexion à la BDD
     */
    public function __construct($host, $user, $pass, $dbname) {
        $this->_db = new mysqli($host, $user, $pass, $dbname);
        if ($this->_db->connect_error) {
            die("Erreur de connexion MySQLi : " . $this->_db->connect_error);
        }
    }
     
    /**
     * Récupération d'un user par son id (adresse mail) — vulnérable
     */
    public function get($userId) {
        $sql = "SELECT *
                FROM user
                WHERE userId = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($donnees = $result->fetch_assoc()) {  
            return new user($donnees);
        }
    }

    /**
     * Vérifie si un utilisateur existe (id + mdp) — vulnérable
     */
    public function userExist($userId, $userPwd) {
        $sql = "SELECT userId
                FROM user
                WHERE userId = ?
                AND userPwd = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->bind_param("ss", $userId, $userPwd);
        $stmt->execute();
        $result = $stmt->get_result();
        return ($result && $result->num_rows > 0);
    }
    
    /**
     * Vérifie si un id existe — vulnérable
     */
    public function idExist($userId) {
        $sql = "SELECT userId
                FROM user
                WHERE userId = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return ($result && $result->num_rows > 0);
    }
    
    /** 
     * Récupération de tous les users
     */
    public function getList() {
        $users = [];
        $sql = "SELECT *
                FROM user";
        $result = $this->_db->query($sql);
        while ($donnees = $result->fetch_assoc()) {
            $users[] = new user($donnees);
        }
        return $users;
    }
     
    /**
     * Ajoute un nouvel utilisateur — vulnérable
     */
    public function add($user) {
        $sql = "INSERT INTO user(userId, userPwd)
                VALUES (?, ?)";
        $stmt = $this->_db->prepare($sql);
        $userId = $user->getUserId();
        $userPwd = $user->getUserPwd();
        $stmt->bind_param("ss", $userId, $userPwd);
        return $stmt->execute();
    }

    /**
     * Supprime un utilisateur — vulnérable
     */
    public function delete($user) {
        $sql = "DELETE FROM user WHERE userId = ?";
        $stmt = $this->_db->prepare($sql);
        $userId = $user->getUserId();
        $stmt->bind_param("s", $userId);
        return $stmt->execute();
    }
    
    /**
     * Met à jour un utilisateur — vulnérable
     */
    public function update($userUpdate) {
        $sql = "UPDATE user 
                SET userPwd = ?
                WHERE userId = ?";
        $stmt = $this->_db->prepare($sql);
        $userPwd = $userUpdate->getUserPwd();
        $userId = $userUpdate->getUserId();
        $stmt->bind_param("ss", $userPwd, $userId);
        return $stmt->execute();
    }
}