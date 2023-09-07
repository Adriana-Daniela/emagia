<?php
declare(strict_types=1);

use Adriana\Emagia\Application\GameFight;
use Adriana\Emagia\Presentation\Controller\GameController;

require_once dirname(__DIR__).'/vendor/autoload.php';

$gameFight = new GameFight();
$game = new GameController($gameFight);
$game->start();
