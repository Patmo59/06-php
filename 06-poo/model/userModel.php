<?php 
namespace Model;
use Class\AbstractModel;
class userModel extends AbstractModel
{
    public function getAllUsers(): array|false
    {
        $sql = $this ->pdo ->query("SELECT idUser, username From users ");
        return $sql ->fetchAll();
    }
    /**
 * Selectionne un utilisateur par son Email.
 *
 * @param string $email
 * @return array|boolean
 */
function getOneUserByEmail(string $email): array | false
{
    $pdo = connexionPDO();
    $sql = $this -> pdo->prepare("SELECT * FROM users WHERE email=:em");
    $sql->execute(["em" => $email]);
    return $sql->fetch();
}
/**
 * Selectionne un utilisateur par son id.
 *
 * @param integer $id
 * @return array|boolean
 */
function getOneUserById(int $id): array | false
{
    $pdo = connexionPDO();
    $sql = $this -> pdo->prepare("SELECT * FROM users WHERE idUser=?");
    $sql->execute([$id]);
    return $sql->fetch(); //!  Fatal error: Uncaught TypeError: Return value of getOneUserById() must be an instance of array | false, array returned in C:\xampp\htdocs\05-mvc\model\userModel.php:35 Stack trace: #0 C:\xampp\htdocs\05-mvc\controller\messageController.php(19): getOneUserById(6) #1 C:\xampp\htdocs\05-mvc\index.php(12): readMessage() #2 {main} thrown in C:\xampp\htdocs\05-mvc\model\userModel.php on line 35
}
/**
 * Ajoute un utilisateur en BDD
 *
 * @param string $us
 * @param string $em
 * @param string $pass
 * @return void
 */
function addUser(string $us, string $em, string $pass): void
{
    $pdo = connexionPDO();
    $sql = $this -> pdo->prepare(
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
function deleteUserById(int $id):void
{
    $pdo = connexionPDO();
    $sql = $this -> pdo->prepare("DELETE FROM users WHERE idUser=?");
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
function updateUserById(string $username, string $email, string $password, int $id):void
{
    $sql = $this -> pdo->prepare("UPDATE users SET 
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
}

?>