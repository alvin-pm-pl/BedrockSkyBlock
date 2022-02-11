<?php

declare(strict_types=1);

namespace alvin0319\BedrockSkyBlock\provider;

use pocketmine\player\Player;
use pocketmine\promise\Promise;

interface EconomyProvider{

	public function getName() : string;

	public function isValid() : bool;

	/** @return Promise<int|float> */
	public function getMoney(Player $player, ?string $currencyName = null) : Promise;

	/** @return Promise<mixed> */
	public function reduceMoney(Player $player, float|int $money, ?string $currencyName = null) : Promise;

	/** @return Promise<mixed> */
	public function addMoney(Player $player, float|int $money, ?string $currencyName = null) : Promise;

	public function getDefaultCurrency() : string;
}