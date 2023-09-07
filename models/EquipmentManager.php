<?php

require_once('Manager.php');
require_once('entities/EquipmentEntity.php');

/**
 * Summary of EquipmentManager
 */
class EquipmentManager extends Manager
{
    /**
     * Summary of fetchEquipment
     * @param int $id
     * @return EquipmentEntity
     */
    public function fetchEquipment(int $id): EquipmentEntity
    {
        $req = $this->db->prepare('
        SELECT *
        FROM equipments
        WHERE equipments.id = ?
        ');
        $req->execute([$id]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $equipment = new EquipmentEntity($result['name'], $result['id']);
        var_dump($equipment);
        return $equipment;


    }
    /**
     * Summary of fetchEquipments
     * @return EquipmentEntity[]
     */
    public function fetchEquipments(): array
    {
        $req = $this->db->query('
        SELECT *
        FROM equipments
        ORDER BY name DESC
        ');
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $equipment = new EquipmentEntity($row['name'], $row['id']);
            $result[] = $equipment;
        }
        var_dump($result);
        return $result;
    }
    public function insertEquipment(EquipmentEntity $equipmentEntity)
    {
        $req = $this->db->prepare('
        INSERT INTO equipments(id, name)
        VALUES (?,?)
        ');
        $req->execute([$equipmentEntity->getId(), $equipmentEntity->getName()]);
    }

    /**
     * Summary of getEquipmentsForRecipe
     * @param int $id
     * @return EquipmentEntity[]
     */
    public function fetchEquipmentsForRecipe(int $id): array
    {
        $req = $this->db->prepare('
        SELECT recipes_equipments.*, equipments.*
        FROM recipes_equipments
        INNER JOIN equipments ON equipments.id = recipes_equipments.equipment_id
        WHERE recipes_equipments.recipe_id = ?
        ');
        $req->execute([$id]);
        $result = $req->fetchAll(PDO::FETCH_ASSOC);

        $equipments = [];
        foreach ($result as $row) {
            $equipment = new EquipmentEntity($row['name'], $row['id']);
            $equipments[] = $equipment;
        }
        var_dump($equipments);
        return $equipments;

    }
    public function deleteEquipment(int $id)
    {
        $req = $this->db->prepare('
        DELETE
        FROM equipments
        WHERE equipments.id = ?
        ');
        $req->execute([$id]);
    }
}