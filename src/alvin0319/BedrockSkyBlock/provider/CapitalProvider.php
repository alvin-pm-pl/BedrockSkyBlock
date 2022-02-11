<?php

declare(strict_types=1);

namespace alvin0319\BedrockSkyBlock\provider;

use pocketmine\player\Player;
use pocketmine\promise\Promise;
use SOFe\Capital\Capital;
use SOFe\Capital\Transfer\CommandMethod;
use function class_exists;

final class CapitalProvider implements EconomyProvider{

	// TODO: Fully implement this

	private CommandMethod $method;

	public function __construct(){
		if(!class_exists(Capital::class)){
			// TODO: error message on here
			return;
		}
	}

	public function getName() : string{
		return "Capital";
	}

	public function isValid() : bool{
		return class_exists(Capital::class);
	}

	public function getMoney(Player $player, ?string $currencyName = null) : Promise{
//		$resolver = new PromiseResolver();
//		Await::f2c(function() use ($player, $currencyName, $resolver) : \Generator{
//			/** @var Database $database
//			 */
//			$database = MainClass::$context->fetchClass(Database::class);
//			$label = yield from $database->getAccountLabel();
//		});
//		return $resolver->getPromise();
		throw new \BadMethodCallException("Not implemented yet");
	}

	public function reduceMoney(Player $player, float|int $money, ?string $currencyName = null) : Promise{
		throw new \BadMethodCallException("Not implemented yet");
	}

	public function addMoney(Player $player, float|int $money, ?string $currencyName = null) : Promise{
		throw new \BadMethodCallException("Not implemented yet");
	}

	public function getDefaultCurrency() : string{
		throw new \BadMethodCallException("Not implemented yet");
	}
}