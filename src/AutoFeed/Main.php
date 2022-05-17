<?php

namespace AutoFeed;

use AutoFeed\command\AutoFeedCommand;
use AutoFeed\task\AutoFeedTask;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Main extends PluginBase
{

    use SingletonTrait;

    public Config $data;

    protected function onLoad(): void
    {
        self::setInstance($this);
    }

    protected function onEnable(): void
    {
       $this->data = new Config($this->getDataFolder()."data.yml", Config::YAML);
       $this->data->save();
       $this->getScheduler()->scheduleRepeatingTask(new AutoFeedTask(), 20);
       Main::getInstance()->getServer()->getCommandMap()->register("autofeed", new AutoFeedCommand("autofeed"));
    }

    public function getData(): Config
    {
        return $this->data;
    }

    public function isAutoFeed(Player $player): bool
    {
        if (!$this->data->exists($player->getName())) return false;
        if ($this->data->get($player->getName()) === "true") return true;
        if ($this->data->get($player->getName()) === "false") return false;
        return false;
    }

}