<?php

require_once('Manager.php');

/**
 * Summary of EquipmentManager
 */
class EquipmentManager extends Manager
{
    /**
     * Summary of getEquipmentsForRecipe
     * @param int $id
     * @return EquipmentEntity[]
     */
    public function getEquipmentsForRecipe(int $id): array
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
}