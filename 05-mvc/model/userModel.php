<?php 
require_once __DIR__."/../../ressources/service/_pdo.php";
/**
 * Récupère tous les utilisateurs.
 *
 * @return array
 */
function getAllUsers(): array{
    $pdo = connexionPDO();
    $sql = $pdo->query("SELECT idUser, username FROM users");
    return $sql->fetchAll();
}
/**
 * Selectionne un utilisateur par son Email.
 *
 * @param string $email
 * @return array|boolean
 */
function getOneUserByEmail(string $email): array|bool{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM users WHERE email=:em");
    $sql->execute(["em" => $email]);
    return $sql->fetch();
}
/**
 * Selectionne un utilisateur par son id.
 *
 * @param integer $id
 * @return array|boolean
 */
function getOneUserById(int $id): array|bool{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM users WHERE idUser=?");
    $sql->execute([$id]);
    return $sql->fetch();
}
/**
 * Ajoute un utilisateur en BDD
 *
 * @param string $us
 * @param string $em
 * @param string $pass
 * @return void
 */
function addUser(string $us, string $em, string $pass): void{
    $pdo = connexionPDO();
    $sql = $pdo->prepare(
        "INSERT INTO users(username, email, password) 
        VALUES(?, ?, ?)"
    );
    $sql->execute([$us,$em,$pass]);
}
/**
 * Supprime un utilisateur par son id.
 *
 * @param integer $id
 * @return void
 */
function deleteUserById(int $id):void{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("DELETE FROM users WHERE idUser=?");
    $sql->execute([$id]);
}
/**
 * Met à jour l'utilisateur via son id.
 *
 * @param string $username
 * @param string $email
 * @param string $password
 * @param integer $id
 * @return void
 */
function updateUserById(string $username, string $email, string $password, int $id):void{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("UPDATE users SET 
            username=:us, 
            email = :em,
            password = :mdp
            WHERE idUser = :id"
            );
    $sql->execute([
        "id" => $id,
        "em" => $email,
        "mdp" => $password,
        "us" => $username
    ]);
}
?>