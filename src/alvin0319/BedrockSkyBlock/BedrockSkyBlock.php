<?php

declare(strict_types=1);

namespace alvin0319\BedrockSkyBlock;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

final class BedrockSkyBlock extends PluginBase{
	use SingletonTrait;

	public static function getInstance() : BedrockSkyBlock{
		return self::$instance;
	}

	protected function onLoad() : void{
		self::setInstance($this);
	}
}