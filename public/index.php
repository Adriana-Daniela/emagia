<?php
declare(strict_types=1);

use Adriana\Emagia\Application\GameFight;
use Adriana\Emagia\Application\PlayerSelector;
use Adriana\Emagia\Presentation\Controller\GameController;

require_once dirname(__DIR__).'/vendor/autoload.php';

$playerSelection = new PlayerSelector();
$gameFight = new GameFight($playerSelection);
$game = new GameController($gameFight);

$game->start();
