<?php

declare(strict_types=1);

namespace alvin0319\BedrockEconomy\provider;

use alvin0319\BedrockSkyBlock\BedrockSkyBlock;
use alvin0319\BedrockSkyBlock\provider\EconomyProvider;
use cooldogedev\BedrockEconomy\BedrockEconomy;
use cooldogedev\libSQL\context\ClosureContext;
use pocketmine\player\Player;
use pocketmine\promise\Promise;
use pocketmine\promise\PromiseResolver;

final class BedrockEconomyProvider implements EconomyProvider{

	private ?BedrockEconomy $economy = null;

	public function __construct(private BedrockSkyBlock $plugin){
		if($this->plugin->getServer()->getPluginManager()->getPlugin("BedrockEconomy") === null){
			// TODO: error message on here
			return;
		}
		$this->economy = BedrockEconomy::getInstance();
	}

	public function getName() : string{
		return "BedrockEconomy";
	}

	public function isValid() : bool{
		return $this->economy !== null;
	}

	public function getMoney(Player $player, ?string $currencyName = null) : Promise{
		$resolver = new PromiseResolver();
		$this->economy->getAPI()->getPlayerBalance($player->getName(), ClosureContext::create(function(?int $balance) use ($resolver) : void{
			if($balance === null){
				$resolver->reject();
				return;
			}
			$resolver->resolve($balance);
		}));
		return $resolver->getPromise();
	}

	public function reduceMoney(Player $player, float|int $money, ?string $currencyName = null) : Promise{
		$resolver = new PromiseResolver();
		$this->getMoney($player, $currencyName)->onCompletion(function(int|float $currentMoney) use ($player, $money, $resolver) : void{
			if($currentMoney < $money){
				$resolver->reject();
				return;
			}
			$this->economy->getAPI()->subtractFromPlayerBalance($player->getName(), $money);
			$resolver->resolve($currentMoney - $money);
		}, fn() => $resolver->reject());
		return $resolver->getPromise();
	}

	public function addMoney(Player $player, float|int $money, ?string $currencyName = null) : Promise{
		$resolver = new PromiseResolver();
		$this->economy->getAPI()->addToPlayerBalance($player->getName(), $money);
		$resolver->resolve($money);
		return $resolver->getPromise();
	}

	public function getDefaultCurrency() : string{
		return $this->economy->getCurrencyManager()->getSymbol();
	}
}