<?php

declare(strict_types=1);

namespace alvin0319\BedrockSkyBlock\world;

use pocketmine\world\format\io\BaseWorldProvider;
use pocketmine\world\format\io\ChunkData;
use pocketmine\world\format\io\WorldData;
use pocketmine\world\format\io\WritableWorldProvider;
use pocketmine\world\World;

final class SQLWorldProvider extends BaseWorldProvider implements WritableWorldProvider{

	public function __construct(string $path){
		parent::__construct($path);
	}

	protected function loadLevelData() : WorldData{
		// TODO: Implement loadLevelData() method.
	}

	public function getWorldMinY() : int{
		return World::Y_MIN;
	}

	public function getWorldMaxY() : int{
		return World::Y_MAX;
	}

	public function loadChunk(int $chunkX, int $chunkZ) : ?ChunkData{
		// TODO: Implement loadChunk() method.
	}

	public function doGarbageCollection() : void{
		// TODO: Implement doGarbageCollection() method.
	}

	public function close() : void{
		// TODO: Implement close() method.
	}

	public function getAllChunks(bool $skipCorrupted = false, ?\Logger $logger = null) : \Generator{
		// TODO: Implement getAllChunks() method.
	}

	public function calculateChunkCount() : int{
		// TODO: Implement calculateChunkCount() method.
	}

	public function saveChunk(int $chunkX, int $chunkZ, ChunkData $chunkData) : void{
		// TODO: Implement saveChunk() method.
	}
}