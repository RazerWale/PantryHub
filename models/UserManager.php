<?php
require_once('Manager.php');
require_once('entities/UserEntity.php');

/**
 * Summary of UserManager
 */
class UserManager extends Manager
{
    /**
     * Summary of fetchUser
     * @param int $id
     * @return UserEntity
     */
    public function fetchUser(int $id): UserEntity
    {
        $req = $this->db->prepare('
        SELECT *
        FROM users
        WHERE users.id = ?
        ');
        $req->execute([$id]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $user = new UserEntity($result['username'], $result['email'], $result['password'], $result['id'], new DateTime($result['created_at']));
        var_dump($user);
        return $user;
    }
    /**
     * Summary of fetchUsers
     * @return UserEntity[]
     */
    public function fetchUsers(): array
    {
        $req = $this->db->query('
        SELECT *
        FROM users
        ORDER BY username DESC
        ');
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $user = new UserEntity($row['username'], $row['email'], $row['password'], $row['id'], new DateTime($row['created_at']));
            $result[] = $user;
        }
        var_dump($result);
        return $result;
    }
    /**
     * Summary of addUser
     * @param UserEntity $user
     */
    public function insertUser(UserEntity $user)
    {
        $req = $this->db->prepare('
        INSERT INTO users(username,
        email,
        password)
        VALUES (?,?,?)
        ');
        $req->execute([$user->getUsername(), $user->getEmail(), $user->getPassword()]);
    }
    public function deleteUser(int $id)
    {
        $req = $this->db->prepare('
        DELETE
        FROM users
        WHERE users.id = :id
        ');
        $req->execute(['id' => $id]);
    }
    public function fetchUserByEmailOrUsername(string $emailOrUsername): ?UserEntity
    {
        $req = $this->db->prepare('
        SELECT *
        FROM users
        WHERE users.username = :emailOrUsername OR users.email = :emailOrUsername
        ');
        $req->execute(['emailOrUsername' => $emailOrUsername]);
        $row = $req->fetch(PDO::FETCH_ASSOC);
        if (empty($row)) {
            return null;
        }
        return new UserEntity($row['username'], $row['email'], $row['password'], $row['id'], new DateTime($row['created_at']));
    }
}