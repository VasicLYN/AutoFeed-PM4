<?php

namespace AutoFeed\command;

use AutoFeed\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class AutoFeedCommand extends Command
{

    public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player){
            $sender->sendMessage(TextFormat::colorize("&cOnly In-Game"));
            return;
        }
        if (empty($args[0])){
            $sender->sendMessage(TextFormat::colorize("&cUse: /autofeed [enable/disable]"));
            return;
        }
        if ($args[0] === "enable"){
            $config = Main::getInstance()->getData();
            $config->set($sender->getName(), "true");
            $config->save();
            return;
        }
        if ($args[0] === "disable"){
            $config = Main::getInstance()->getData();
            $config->set($sender->getName(), "false");
            $config->save();
            return;
        }
    }

}