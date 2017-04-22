<?php
namespace xcrate\entity;

use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\Player;
use xcrate\ExCrate;

class Crate extends Position {

    /** @var ParticleEffect[] */
    protected $particles = [];

    /** @var ExCrate */
    protected $plugin;

    public function __construct(ExCrate $plugin, $x = 0, $y = 0, $z = 0, Level $level = null, array $data)
    {
        parent::__construct($x, $y, $z, $level);
        $this->plugin;
        // Load data
    }

    public function getPlugin(): ExCrate {
        return $this->plugin;
    }

    public function __toArray(): array {
	    return []; // TODO
    }

    public function onOpen(Player $player, Key $key) {

    }

    public function getBlock() {
        return $this->getLevel()->getBlock($this);
    }

    public function getTile() {
        return $this->getLevel()->getTile($this);
    }

    public function hash(): string {
        return implode(":", [$this->x, $this->y, $this->z, $this->level->getName()]);
    }
	
}