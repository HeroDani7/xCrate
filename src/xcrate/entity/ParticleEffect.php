<?php
namespace xcrate\entity;

use pocketmine\scheduler\Task;

abstract class ParticleEffect extends Task
{

    /** @var Crate */
    protected $crate;

    public function __construct(Crate $crate, array $settings = []) {
        $this->crate = $crate;
    }

}