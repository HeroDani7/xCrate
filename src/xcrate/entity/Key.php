<?php
namespace xcrate\entity;

use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\Player;
use xcrate\ExCrate;

class Key extends Item
{

    /** @var ExCrate */
    protected $plugin;

    /** @var Crate[] */
    protected $targets = [];

    /** @var string */
    protected $permission;


    /**
     * Key constructor.
     * @param ExCrate $plugin
     * @param int $id
     * @param int $meta
     * @param int $count
     * @param string $name
     * @param array $data
     */
    public function __construct(ExCrate $plugin, $id, $meta = 0, $count = 1, $name, array $data)
    {
        parent::__construct($id, $meta, $count, $name);
        // Load data
        // TODO
        $this->plugin = $plugin;
        // Write key data to compound tag, or something :D
    }

    public function getPlugin()
    {
        return $this->plugin;
    }

    public function __toArray() {
        // TODO
        return [];
    }

    /**
     * @param Player $player
     * @param Crate $crate
     * @return bool
     */
    public function onUse(Player $player, Crate $crate)
    {
        // TODO
        return false;
    }

    public function getPermission()
    {
        return $this->permission;
    }

}