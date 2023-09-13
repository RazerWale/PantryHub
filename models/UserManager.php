<?php
require_once('Manager.php');
require_once('entities/UserEntity.php');
require_once('entities/UsersIngredientsEntity.php');

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
    public function fetchUserEquipments(int $id): array
    {
        $req = $this->db->prepare('
        SELECT *
        FROM equipments
        INNER JOIN users_equipments ON users_equipments.equipment_id = equipments.id
        WHERE users_equipments.user_id = ?
        ');
        $req->execute([$id]);
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);
        if (empty($rows)) {
            throw new Exception('no equipments for this user');
        }
        $result = [];
        foreach ($rows as $row) {
            $equipment = new EquipmentEntity($row['name'], $row['equipment_id'], $row['image_url']);
            $result[] = $equipment;
        }
        return $result;
    }
    public function deleteUserEquipment(int $id, int $equipmentId)
    {
        $req = $this->db->prepare('
        DELETE 
        FROM users_equipments
        WHERE users_equipments.user_id = ? AND users_equipments.equipment_id = ?
        ');
        $req->execute([$id, $equipmentId]);
    }
    public function insertUserEquipment(int $id, int $equipment)
    {
        $req = $this->db->prepare('
        INSERT INTO users_equipments(user_id, equipment_id)
        VALUES (?,?)
        ');
        $req->execute([$id, $equipment]);
    }
    public function insertUserIngredient(int $userId, UsersIngredientsEntity $userIngredients)
    {
        $req = $this->db->prepare('
        INSERT INTO users_ingredients(user_id, 
        ingredient_id, 
        quantity_us, 
        quantity_metric, 
        unit_us, 
        unit_metric)
        VALUES (?,?,?,?,?,?)
        ');
        $req->execute([
            $userId,
            $userIngredients->getId(),
            $userIngredients->getQuantityUs(),
            $userIngredients->getQuantityMetric(),
            $userIngredients->getUnitUs(),
            $userIngredients->getUnitMetric()
        ]);
    }
    public function fetchUserIngredients(int $id): array
    {
        $req = $this->db->prepare('
        SELECT *
        FROM users_ingredients
        INNER JOIN ingredients ON users_ingredients.ingredient_id = ingredients.id
        WHERE users_ingredients.user_id = ?
        ');
        $req->execute([$id]);
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);
        if (empty($rows)) {
            throw new Exception('no ingredients for this user');
        }
        $result = [];
        foreach ($rows as $row) {
            $equipment = new UsersIngredientsEntity($row['name'], $row['ingredient_id'], $row['image_url'], $row['calories'], $row['type']);
            $equipment->setQuantityMetric($row['quantity_metric'])
                ->setQuantityUs($row['quantity_us'])
                ->setUnitMetric($row['unit_metric'])
                ->setUnitUs($row['unit_us']);
            $result[] = $equipment;
        }
        return $result;
    }
    public function deleteUserIngredient(int $id, int $ingredientId)
    {
        $req = $this->db->prepare('
        DELETE
        FROM users_ingredients
        WHERE users_ingredients.user_id = ? AND users_ingredients.ingredient_id = ?
        ');
        $req->execute([$id, $ingredientId]);
    }
}