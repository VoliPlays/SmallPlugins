<?php

declare(strict_types=1);

namespace simplehome;

use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\Server;

/**
 * Class Home
 * @package simplehome
 */
final class Home extends Position {

    /**
     * @var Player $owner
     */
    private $owner;

    /**
     * @var string $name
     */
    private $name;

    /**
     * Home constructor.
     * @param Player $player
     * @param array $data
     */
    public function __construct(Player $player, array $data, string $name) {
        parent::__construct(intval($data[0]), intval($data[1]), intval($data[2]), Server::getInstance()->getLevelByName(strval($data[3])));
        $this->owner = $player;
        $this->name = $name;
    }

    /**
     * @param Position $position
     * @param $name
     * @param $player
     * @return Home
     */
    public static function __fromPosition(Position $position, $name, $player):Home {
        return new Home($player, [intval($position->getX()), intval($position->getY()), intval($position->getZ()), $position->getLevel()->getName()], $name);
    }

    /**
     * @return string
     */
    public final function getName():string {
        return $this->name;
    }

    /**
     * @param Player $player
     */
    public final function teleport(Player $player) {
        $player->teleport($this->asPosition());
    }

    /**
     * @return Player
     */
    public final function getOwner():Player {
        return $this->owner;
    }
}