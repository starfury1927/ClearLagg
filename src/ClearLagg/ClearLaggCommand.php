<?php

namespace ClearLagg;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;

class ClearLaggCommand extends Command implements PluginIdentifiableCommand {

  public $plugin;

  public function __construct(Loader $plugin) {
    parent::__construct("clearlagg", "Clear the lag!", "/clearlagg <clear/check/killmobs>", ["lagg"]);
    $this->setPermission("clearlagg.command.clearlagg");
    $this->plugin = $plugin;
  }

  public function getPlugin() {
    return $this->plugin;
  }

  public function execute(CommandSender $sender, $alias, array $args) {
    if(!$this->testPermission($sender)) {
      return false;
    }
    if(isset($args[0])) {
      switch($args[0]) {
        case "clear":
          $sender->sendMessage("Removed " . $this->getPlugin()->removeEntities() . " entities.");
          return true;
        case "check":
        case "count":
          $c = $this->getPlugin()->getEntityCount();
          $sender->sendMessage("There are " . $c[0] . " players, " . $c[1] . " mobs, and " . $c[2] . " entities.");
          return true;
        case "reload":
          // TODO
          return true;
        case "killmobs":
          $sender->sendMessage("Removed " . $this->getPlugin()->removeMobs() . " mobs.");
          return true;
        case "clearall":
          $sender->sendMessage("Removed " . $this->getPlugin()->removeMobs() . " mobs, and " . $this->getPlugin()->removeEntities() . " entities.");
          return true;
        case "area":
          // TODO
          return true;
        case "unloadchunks":
          // TODO
          return true;
        case "chunk":
          // TODO
          return true;
        case "tpchunk":
          // TODO
          return true;
        default:
          return false;
      }
    }
    return false;
  }

}
