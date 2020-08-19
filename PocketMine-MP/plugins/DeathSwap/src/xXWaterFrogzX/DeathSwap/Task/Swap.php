<?php
declare(strict_types=1);

namespace xXWaterFrogzX\DeathSwap\Task;


use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;
use xXWaterFrogzX\DeathSwap\Main;

class Swap extends Task {
    public $timer2 = 312;
    public $main;
    public function __construct(Main $main) {
        $this->main = $main;
    }
    public function onRun(int $currentTick) {
        $playerArray = $this->main->getServer()->getOnlinePlayers();
        $firstPlayer = current($playerArray);
        $secondPlayer = next($playerArray);
        $this->timer2--;
                if ($this->timer2 === 240) {
                    $firstPlayer->sendMessage(TextFormat::RED . TextFormat::BOLD . "Swapping in 4 minutes!");
                    $secondPlayer->sendMessage(TextFormat::RED . TextFormat::BOLD . "Swapping in 4 minutes!");
                }
                if ($this->timer2 === 180) {
                    $firstPlayer->sendMessage(TextFormat::RED . TextFormat::BOLD . "Swapping in 3 minutes!");
                    $secondPlayer->sendMessage(TextFormat::RED . TextFormat::BOLD . "Swapping in 3 minutes!");
                }
                if ($this->timer2 === 120) {
                    $firstPlayer->sendMessage(TextFormat::RED . TextFormat::BOLD . "Swapping in 2 minutes!");
                    $secondPlayer->sendMessage(TextFormat::RED . TextFormat::BOLD . "Swapping in 2 minutes!");
                }
                if ($this->timer2 === 60) {
                    $firstPlayer->sendMessage(TextFormat::RED . TextFormat::BOLD . "Swapping in 1 minute!");
                    $secondPlayer->sendMessage(TextFormat::RED . TextFormat::BOLD . "Swapping in 1 minutes!");
                }
                if ($this->timer2 <= 10) {
                    $firstPlayer->sendMessage(TextFormat::RED . TextFormat::BOLD . "Swapping in " . $this->timer2 . " seconds!");
                    $secondPlayer->sendMessage(TextFormat::RED . TextFormat::BOLD . "Swapping in " . $this->timer2 . " seconds!");
                }
                if ($this->timer2 <= 1) {
                    $fX = $firstPlayer->getX();
                    $fY = $firstPlayer->getY();
                    $fZ = $firstPlayer->getZ();
                    $sX = $secondPlayer->getX();
                    $sY = $secondPlayer->getY();
                    $sZ = $secondPlayer->getZ();
                    $firstPlayer->teleport(new Vector3($sX, $sY, $sZ));
                    $secondPlayer->teleport(new Vector3($fX, $fY, $fZ));
                    $this->timer2 = 312;
                    $this->timer2--;
                }
    }
}