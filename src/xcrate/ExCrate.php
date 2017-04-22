<?php
namespace xcrate;

use pocketmine\item\Item;
use pocketmine\level\Position;
use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use xcrate\entity\Crate;
use xcrate\entity\Key;

class ExCrate extends PluginBase {

	/** @var Crate[] */
	private static $crates = [];
	/** @var Key[] */
	private static $keys = [];

	public function onLoad() {
		@mkdir( $this->getDataFolder() );

		// Load default files into data folder
		$df = $this->getDataFolder();
		if(!file_exists($df."crates.yml")) {
			$this->saveResource("crates.yml");
		}

        if(!file_exists($df."keys.yml")) {
            $this->saveResource("keys.yml");
        }
	}

	public function onEnable() {
        $crates = new Config($this->getDataFolder()."crates.yml", [], Config::YAML);
        $keys = new Config($this->getDataFolder()."keys.yml", [], Config::YAML);
		// Start loading crates
		foreach ($crates->getAll() as $key => $crateData) {
			// This check will throw an error
			try {
				
				$crate = $this->loadCrate($crateData);
				self::$crates[$crate->hash()] = $crate;

			} catch(\Exception $e) {

				$this->getLogger()->error("Crate '$key' has invalid data: ".$e->getMessage());
				continue;

			} finally {
				// Loading particles is done along wi$this, th crates loading
				if(isset($crateData["particles"])) {
					$this->loadParticles($crateData["particles"], $crate);
				}
			}

		}


		// Load keys
		// It's important to load keys after crates, because keys can reffer to crate.
		foreach ($keys->getAll() as $i => $keyData) {
			try {

				$key = $this->loadKey($keyData);
				self::$keys[$i] = $key;

			} catch(\Exception $e) {

				$this->getLogger()->error("Key '$i' has invalid data: ".$e->getMessage());
				continue;

			}
		}

		// Register listeners
		$this->getServer()->getPluginManager()->registerEvents(new EventHandler($this), $this);

		$this->getLogger()->info("Crates loaded: ".TextFormat::GOLD.count(self::$crates));
		$this->getLogger()->info("Keys loaded: ".TextFormat::GOLD.count(self::$keys));
	}

	public function onDisable() {
		$keys = new Config($this->getDataFolder()."keys.yml", [], Config::YAML);
		$crates = new Config($this->getDataFolder()."crates.yml", [], Config::YAML);

		foreach (self::$crates as $key => $value) {
			$crates->set($key, $value->__toArray());
		}

		foreach (self::$keys as $key => $value) {
			$keys->set($key, $value->__toArray());
		}

		array_map(function(Config $config){
			$config->save();
		}, [$keys, $crates]);
		$this->getLogger()->info("Crates and Keys saved!");

	}

    /**
     * @param array $data
     * @return bool
     */
	public function validateCrateData(array $data) {
        // TODO
        return false;
	}

    /**
     * @param array $data
     * @return null|Crate
     */
	public function loadCrate(array $data) {
		if(!$this->validateCrateData($data)) return null;
		// TODO
        return null;
	}

    /**
     * @param array $data
     * @return bool
     */
	public static function validateKeyData(array $data) {
		// TODO
        return false;
	}

    /**
     * @param array $keys
     * @return null|Key
     */
	public function loadKey(array $keys) {
		// TODO
        return null;
	}

	public function loadParticles(array $particles) {
		// TODO
        return null;
	}

	public function loadParticle(array $particleData) {
		// TODO
        return null;
	}

	public function getCrateAt(Position $pos) {

    }

    public function isKey(Item $item): bool {
	    return $item instanceof Key;
    }

}