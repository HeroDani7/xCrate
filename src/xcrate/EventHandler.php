<?php
namespace xcrate;

use pocketmine\block\Block;
use pocketmine\event\inventory\InventoryOpenEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\TextFormat;
use xcrate\entity\Key;

class EventHandler implements Listener
{

    /** @var ExCrate */
    protected $plugin;

    public function __construct(ExCrate $plugin)
    {
        $this->plugin = $plugin;
    }

    public function getPlugin(): ExCrate
    {
        return $this->plugin;
    }

    public function onPlayerInteraction(PlayerInteractEvent $event)
    {
        $block = $event->getBlock();
        if($block->getId() === Block::CHEST || $block->getId() === Block::ENDER_CHEST) {
            $item = $event->getItem();
            $player = $event->getPlayer();
            if (($crate = $this->getPlugin()->getCrateAt($block)) && !$this->getPlugin()->isKey($item)) {
                $player->sendMessage(TextFormat::DARK_RED."This chest is locked");
            } else {
                /** @var Key $item */
                if(!$item->onUse($player, $crate)) {
                    $event->setCancelled(true);
                }
            }
        }
    }

    public function onInventoryOpen(InventoryOpenEvent $event)
    {
        // TODO
    }

}