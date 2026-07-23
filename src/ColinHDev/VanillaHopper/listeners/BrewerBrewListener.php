<?php

declare(strict_types=1);

namespace ColinHDev\VanillaHopper\listeners;

use ColinHDev\VanillaHopper\blocks\Hopper;
use juqngood\hcf\event\brewer\BrewerBrewEvent;
use pocketmine\event\Listener;
use pocketmine\math\Facing;

final class BrewerBrewListener implements Listener {

	private const FACINGS = [
		Facing::DOWN,
		Facing::UP
	];

	public function onBrewerBrew(BrewerBrewEvent $event) : void {
		$brewer = $event->getBrewer();
		$position = $brewer->getPosition();
		$world = $position->getWorld();
		foreach (self::FACINGS as $facing) {
			$block = $world->getBlock($position->getSide($facing));
			if ($block instanceof Hopper) {
				$block->scheduleDelayedBlockUpdate(1);
			}
		}
	}
}