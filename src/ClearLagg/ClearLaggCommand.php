<?php

namespace ClearLagg;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;

class ClearLaggCommand extends Command implements PluginIdentifiableCommand {

  public $plugin;

  public function __construct(Loader $plugin) {
    parent::__construct("클리어렉", "렉을 청소하자!", "/클리어렉 <체트/클리어/몹제거/전부제거>", ["렉"]);
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
          $sender->sendMessage("[클리어렉] " . $this->getPlugin()->removeEntities() . " 만큼의 엔티티가 제거되었습니다 !");
          return true;
        case "check":
        case "count":
          $c = $this->getPlugin()->getEntityCount();
          $sender->sendMessage("[클리어렉] " . $c[0] . " 명의 유저, " . $c[1] . " 개의 몹, and " . $c[2] . " 개의 엔티티가 있습니다.");
          return true;
        case "reload":
          // TODO
          return true;
        case "killmobs":
          $sender->sendMessage("[클리어렉] " . $this->getPlugin()->removeMobs() . " 개의 몹이 제거되었습니다!");
          return true;
        case "clearall":
          $sender->sendMessage("[클리어렉] " . ($d = $this->getPlugin()->removeMobs()) . " 몹" . ($d == 1 ? "" : "s") . " 과 " . ($d = $this->getPlugin()->removeEntities()) . " entit" . ($d == 1 ? "y" : "ies") . ".");
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
