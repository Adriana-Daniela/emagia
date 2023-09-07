<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Result;

class GameResult
{
    private string $winner;

    /**
     * @var array<GameTurnResult>
     */
    private array $turns = [];

    public function addTurn(GameTurnResult $gameTurnResult): self
    {
        $this->turns[] = $gameTurnResult;

        return $this;
    }

    public function getTurns(): array
    {
        return $this->turns;
    }

    public function getWinner(): string
    {
        return $this->winner;
    }

    public function setWinner(string $winner): self
    {
        $this->winner = $winner;

        return $this;
    }
}
