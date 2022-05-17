<?php

namespace AutoFeed\task;

use AutoFeed\Main;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class AutoFeedTask extends Task
{

    public function onRun(): void
    {
        foreach (Server::getInstance()->getOnlinePlayers() as $player){
            if ($player->isOnline()){
                if ($player->hasPermission("autofeed.permission")){
                    if (Main::getInstance()->isAutoFeed($player)){
                        $player->getHungerManager()->setFood(20);
                    }
                }
            }
        }
    }

}