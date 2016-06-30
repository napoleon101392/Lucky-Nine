<?php


class Engine
{

	protected $players = [];

	protected $cards = [
		'heart'    => [1, 2, 3, 4, 5, 6, 7, 8, 9],
		'diamond'  => [1, 2, 3, 4, 5, 6, 7, 8, 9],
		'clover'   => [1, 2, 3, 4, 5, 6, 7, 8, 9],
		'spade'    => [1, 2, 3, 4, 5, 6, 7, 8, 9]
	];

	protected $organizedCards = [];


	public function __construct()
	{
		foreach ($this->cards as $key => $values) {
			foreach ($values as $value) {
				array_push($this->organizedCards, $key. '-' .$value);
			}
		}

		shuffle($this->organizedCards);
	}

	public function addPlayer(Player $player)
	{
		$this->players[] = $player;
	}

	public function countPlayers()
	{
		return count($this->players);
	}

	// public function setHost($idx){}

	public function start()
	{
		//todo: choose Who is the host
		$idx = array_rand($this->players);
		$theChoosenOne = $this->players[$idx];
		$theChoosenOne->setHost(true);

		//todo: validate players count if atleast minimum of two players until 4 players
		if (count($this->players) < 2 || count($this->players) >= 4) {
			throw new Exception("Players should atleast 2 players and minimum of 4 players");
		}

		foreach($this->players as $player) {
			$randomCard1 = explode('-', array_pop($this->organizedCards));
			$player->addCard($randomCard1);

			$randomCard2 = explode('-', array_pop($this->organizedCards));
			$player->addCard($randomCard2);
		}


		// exit();


		//todo: add the total cards each player
		//todo: if host is equal sum of 9, the game is over
	}

	/**
	 * This returns the game results and ends the game already
	 * 
	 * @return array Results
	 */
	public function end()
	{

	}
}

class Player
{
	protected $name;
	protected $cards;
	protected $total;
	protected $bool = false;

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function setHost($bool)
	{
		$this->bool = $bool;
		
		return $this;
	}

	public function addCard($card)
	{
		$this->cards[] = $card;

		return $this;
	}

	public function isHost()
	{
		return $this->bool;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDistributedCards()
	{
		return $this->cards;
	}
}



$engine = new Engine();

$francis = new Player('Francis');
$napoleon = new Player('Napoleon');
$engine->addPlayer($francis);
$engine->addPlayer($napoleon);

$engine->start();

$results = $engine->end();










// $arrs = [
// 	'x' => [1,2,3],
// 	'y' => [4,5,6],
// 	'z' => [7,8,9],
// ];

// $idx = array_rand($arrs);
// $theChoosenOne = $arrs[$idx];
// $theChoosenOne[] = 19999;
// $arrs[$idx] = $theChoosenOne;

// echo '<pre>';
// var_dump($theChoosenOne);
// var_dump($arrs);
// exit;










echo "<pre>";
var_dump($engine);
exit;
