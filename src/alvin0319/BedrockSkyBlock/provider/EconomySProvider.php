<?php

declare(strict_types=1);

namespace alvin0319\BedrockSkyBlock\provider;

use alvin0319\BedrockSkyBlock\BedrockSkyBlock;
use onebone\economyapi\currency\Currency;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use pocketmine\promise\Promise;
use pocketmine\promise\PromiseResolver;
use pocketmine\utils\AssumptionFailedError;

final class EconomySProvider implements EconomyProvider{

	private ?EconomyAPI $economyAPI = null;

	public function __construct(private BedrockSkyBlock $plugin){
		if($this->plugin->getServer()->getPluginManager()->getPlugin("EconomyAPI") === null){
			// TODO: error message on here
			return;
		}
		$this->economyAPI = EconomyAPI::getInstance();
		// TODO: deprecated message on here
	}

	public function getName() : string{
		return "EconomyAPI";
	}

	public function isValid() : bool{
		return $this->economyAPI !== null;
	}

	public function getMoney(Player $player, string $currencyName) : Promise{
		$resolver = new PromiseResolver();
		$money = $this->economyAPI->myMoney($player, $this->getCurrency($currencyName));
		if($money === false){
			$resolver->reject();
		}else{
			$resolver->resolve($money);
		}
		return $resolver->getPromise();
	}

	public function reduceMoney(Player $player, float|int $money, ?string $currencyName = null) : Promise{
		$resolver = new PromiseResolver();
		$result = $this->economyAPI->reduceMoney($player, $money, $this->getCurrency($currencyName ?? $this->getDefaultCurrency()));
		match($result){
			EconomyAPI::RET_SUCCESS => $resolver->resolve($result),
			default => $resolver->reject()
		};
		return $resolver->getPromise();
	}

	public function addMoney(Player $player, float|int $money, ?string $currencyName = null) : Promise{
		$resolver = new PromiseResolver();
		$result = $this->economyAPI->addMoney($player, $money, $this->getCurrency($currencyName ?? $this->getDefaultCurrency()));
		match($result){
			EconomyAPI::RET_SUCCESS => $resolver->resolve($result),
			default => $resolver->reject()
		};
		return $resolver->getPromise();
	}

	public function getDefaultCurrency() : string{
		return $this->economyAPI->getDefaultCurrencyId();
	}

	public function getCurrency(string $name) : Currency{
		$currency = $this->economyAPI->getCurrency($name);
		if($currency === null){
			throw new AssumptionFailedError("Currency $name does not exist");
		}
		return $currency;
	}
}