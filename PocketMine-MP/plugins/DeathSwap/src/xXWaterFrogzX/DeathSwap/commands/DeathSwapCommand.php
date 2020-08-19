<?php
declare(strict_types=1);

namespace xXWaterFrogzX\DeathSwap\commands;


use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\TextFormat;
use xXWaterFrogzX\DeathSwap\Main;
use xXWaterFrogzX\DeathSwap\Task\CountDown;
use xXWaterFrogzX\DeathSwap\Task\Swap;

class DeathSwapCommand extends PluginCommand
{
    private $main;

    public function __construct(Main $main)
    {
        parent::__construct("ds", $main);
        $this->setMain($main);
        $this->setAliases(["deathswap"]);
        $this->setPermission("deathswap.command");
        $this->setDescription("DeathSwap main command");
    }

    public function getMain(): Main
    {
        return $this->main;
    }

    public function setMain(Main $main)
    {
        $this->main = $main;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$sender->hasPermission($this->getPermission())) {
            $sender->sendMessage(TextFormat::RED . "You do not have access to this command!");
        } else {
            switch ($args[0] ?? "help") {
                case "help";
                {
                    $red = TextFormat::RED;
                    $lines = TextFormat::BLUE . "--------------------------------------------------------";
                    $sender->sendMessage($lines . "\n" . $red . "/ds info - General info about the plugin \n" . $red . "/ds start - Starts the game\n" . $red . "/ds help - Lists all the commands \n" . $lines);
                    return true;
                    break;
                }
                case "info"; {
                    $sender->sendMessage(TextFormat::RED . "This is a public free plugin made by xXWaterFrogzX! Hope you guys enjoy the plugin!");
                    return true;
                    break;
                }
                case "start"; {
                    $onlinePlayers = count($sender->getServer()->getOnlinePlayers());
                    if ($onlinePlayers != 2) {
                        $sender->sendMessage(TextFormat::RED . "You need exactly 2 players on the server");
                    } else {
                        $this->getMain()->setGame(true);
                        $this->getMain()->getScheduler()->scheduleRepeatingTask(new CountDown($this->getMain()), 20);
                        $this->getMain()->getScheduler()->scheduleRepeatingTask(new Swap($this->getMain()), 20);
                    }
                }
            }
            return true;
        }
        return true;
    }
}