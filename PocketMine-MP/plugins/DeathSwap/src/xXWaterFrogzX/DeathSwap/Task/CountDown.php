<?php
declare(strict_types=1);

namespace xXWaterFrogzX\DeathSwap\Task;


use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;
use xXWaterFrogzX\DeathSwap\Main;

class CountDown extends Task {
    public $timer = 11;
    public $main;
        public function __construct(Main $main) {
            $this->main = $main;
        }
        public function onRun(int $currentTick) {
            $this->timer--;
            foreach ($this->main->getServer()->getOnlinePlayers() as $players) {
                $players->sendTitle(TextFormat::RED . "Game starting in " . $this->timer, TextFormat::GREEN . "Get ready!");
                if ($this->timer <= 1) {
                    $x = mt_rand(0, 1000);
                    $y = 150;
                    $z = mt_rand(0, 1000);
                    $steak = Item::get(Item::COOKED_BEEF)->setCount(64);
                    $players->getInventory()->clearAll();
                    $players->getArmorInventory()->clearAll();
                    $players->getInventory()->setItem(8, $steak);
                    $players->setGamemode(0);
                    $players->setHealth(20);
                    $players->setFood(20);
                    $players->teleport(new Vector3($x, $y, $z));
                    $players->addEffect(new EffectInstance(Effect::getEffect(15), 100, 1));
                    $players->addEffect(new EffectInstance(Effect::getEffect(11), 100, 250));
                    $this->main->getScheduler()->cancelTask($this->getTaskId());
                }
            }
        }
}