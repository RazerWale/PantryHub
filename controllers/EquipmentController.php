<?php

require_once('models/EquipmentManager.php');
class EquipmentController
{
    protected $equipmentManager;
    public function __construct()
    {
        $this->equipmentManager = new EquipmentManager();
    }
    public function getEquipment()
    {
        $id = 778;
        $equipment = $this->equipmentManager->fetchEquipment($id);
        require_once('views/main.php');
    }
}