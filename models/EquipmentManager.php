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
    public function fetchEquipment(int $id): ?EquipmentEntity
    {
        $req = $this->db->prepare('
        SELECT *
        FROM equipments
        WHERE equipments.id = ?
        ');
        $req->execute([$id]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $equipment = new EquipmentEntity($result['name'], $result['id'], $result['image']);
        return $equipment;
    }
    /**
     * Summary of fetchEquipments
     * @return EquipmentEntity[]
     */
    public function fetchEquipments(): ?array
    {
        $req = $this->db->query('
        SELECT *
        FROM equipments
        ORDER BY name DESC
        ');
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $equipment = new EquipmentEntity($row['name'], $row['id'], $row['image']);
            $result[] = $equipment;
        }
        return $result;
    }
    public function insertEquipment(EquipmentEntity $equipmentEntity)
    {
        $req = $this->db->prepare('
        INSERT INTO equipments(id, name, image)
        VALUES (?,?,?)
        ');
        $req->execute([$equipmentEntity->getId(), $equipmentEntity->getName(), $equipmentEntity->getImage()]);
    }

    /**
     * Summary of getEquipmentsForRecipe
     * @param int $id
     * @return EquipmentEntity[]
     */
    public function fetchEquipmentsForRecipe(int $id): ?array
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
            $equipment = new EquipmentEntity($row['name'], $row['id'], $row['image_url']);
            $equipments[] = $equipment;
        }
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

    public function appliancesbyLetter(string $applianceSearchItem)
    {
        $searchParams = '%' . $applianceSearchItem . '%';

        $req = $this->db->prepare('
        SELECT DISTINCT equipments.name as equipment_name, equipments.id as id 
        FROM equipments
        WHERE LOWER(equipments.name) LIKE LOWER(:applianceSearchItem)');
        $req->bindParam(':applianceSearchItem', $searchParams, PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}