<?php
declare(strict_types=1);

namespace xXWaterFrogzX\DeathSwap;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use xXWaterFrogzX\DeathSwap\commands\DeathSwapCommand;

class Main extends PluginBase  implements Listener {
    public $game = false;
    public function onEnable(){
        $this->getLogger()->info("DeathSwap has been enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getCommandMap()->registerAll("command", [


            new DeathSwapCommand($this),

            ]);
    }
    public function onDisable(){
        $this->getLogger()->info("Disabling DeathSwap...");
    }
    public function isGame() : bool {
        return $this->game;
    }
    public  function setGame(bool $game) {
        $this->game = $game;
    }
    public function onDeath(PlayerDeathEvent $event)  {
        $player = $event->getPlayer();
        $playerName = $player->getName();
        if ($this->isGame() === true) {
            foreach ($this->getServer()->getOnlinePlayers() as $players) {
                $players->sendMessage(TextFormat::RED . TextFormat::BOLD . $playerName . " has lost the game!");
                $this->getScheduler()->cancelAllTasks();
                $this->setGame(false);
            }
        }
    }
    public function onQuit(PlayerQuitEvent $event) : void {
        $player = $event->getPlayer();
        $name = $player->getName();
        if ($this->isGame() === true) {
            foreach ($this->getServer()->getOnlinePlayers() as $players) {
                $players->sendMessage(TextFormat::RED . TextFormat::BOLD . $name . " has lost the game!");
                $this->getScheduler()->cancelAllTasks();
                $this->setGame(false);
            }
        } else {
            return;
        }
    }
}