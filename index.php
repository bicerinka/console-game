<?php
class Room {
    public static $coordinates_let = [[5,23],[6,23],[4,23],[6,22],[5,22],[4,22],[6,21],[5,21],[4,21],[5,20]];
    public static $coordinates_jewel = [[16,22],[15,22],[16,21],[15,21],[16,20],[15,20],[14,22],[14,21],[14,20],[16,19],[15,19],[14,19],[16,18],[15,18],[14,18]];
    private $room = [
        0  => [' ', ' ', ' ', ' ', ' ', ' ', '|#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        1  => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        2  => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', '^', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        3  => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', '(', '@', ')', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        4  => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', '|', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '  ', ' ', ' ', ' ', ' ', ' ', ' '],
        5  => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', '/', '|', '\\', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '  ', ' ', ' ', ' ', ' ', ' ', ' '],
        6  => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', '|', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '  ', ' ', ' ', ' ', ' ', ' ', ' '],
        7  => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', '/', ' ', '\\ ', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        8  => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        9  => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        10 => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        11 => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        12 => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        13 => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        14 => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        15 => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        16 => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        17 => [' ', ' ', ' ', ' ', ' ', ' ', '|#', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
        18 => [' ', ' ', ' ', ' ', ' ', ' ', '|#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#|', ' ', ' ', ' ', ' ', ' ', ' '],
    ];
    // дополнительные предметы в комнате, например, сокровища или препятствия
    public function setRoom($coordinates, $count, $cell) {
        for ($i = 0; $i < $count; $i++){
            $position = self::${$coordinates}[$i];
            $this->room[$position[0]][$position[1]] = $cell;
        }
    }

    public function getRoom() {
        return $this->room;
    }
}

abstract class Builder {
    protected $room;
    protected $count;

    public function __construct($count = '')
    {
        $this->count = $count;
    }

    final public function getRoom() {
        return $this->room;
    }

    public function buildRoom() {
        $this->room = new Room();
    }
}

class EmptyRoom extends Builder {
    public function buildRoom() {
        parent::buildRoom();
    }
}

class JewelRoom extends Builder {
    private $cell = '+';
    public function buildRoom() {
        parent::buildRoom();
        $this->room->setRoom('coordinates_jewel', $this->count, $this->cell);
    }
}

class LetRoom extends Builder {
    private $cell = '=';
    public function buildRoom() {
        parent::buildRoom();
        $this->room->setRoom('coordinates_let', $this->count, $this->cell);
    }
}

class Factory {
    private $builder;

    public function __construct(Builder $builder) {
        $this->builder = $builder;
        $this->builder->buildRoom();
    }

    public function getRoom() {
        return $this->builder->getRoom();
    }
}

class Game {
    private static $room = 0; // вид комнаты
    private static $count = 0; // величина сокровища или препятствия
    private static $gameField = []; // координаты для построения
    private static $mark = 0; // количество баллов
    private static $time = 0; // время между выстрелами

    public static function init() {
        self::$mark = 50;
        self::$time = 0;
        self::runGame();
    }

    private static function showTitle() {
        self::clearScreen();

        echo <<<EOD
=========================================================
 Для окончания игры нажмите *. 
=========================================================

EOD;
    }

    private static function runGame() {
        self::startNewGame();
        self::drawField();
        self::makeMove(true);
    }

    private static function continueGame() {
        self::drawField();
        self::makeMove(true);
    }

    private static function startNewGame() {
        self::$room = rand(0,2);
        if(self::$room == 1){
            // комната с сокровищем
            self::$count = rand(5,15);
            $room = new Factory(new JewelRoom(self::$count));
        }else if(self::$room == 2){
            // комната с препятствием
            self::$count = rand(2,10);
            $room = new Factory(new LetRoom(self::$count));
        }else{
            $room = new Factory(new EmptyRoom());
        }
        self::$gameField = $room->getRoom()->getRoom();
    }

    private static function makeMove($isUserMove) {
        // допустимые команды
        if(in_array($isUserMove, ['*',1,2,3])){
            $commands = ['1 - перейти дальше', '1 - перейти дальше, 2 - взять сокровище', '3 - стрелять'];

            $index = self::$room == 2 && self::$count == 0 ? 0 : self::$room;

            echo "\nКоличество очков: " . self::$mark. " Выберите действие: {$commands[$index]} ";

            $userChoice = $isUserMove === true ? substr(fgets(STDIN), 0, 1) : '';

            switch ($userChoice) {
                case '*':
                    self::gameOver();
                case 1:
                    // перейти дальше
                    if(self::$room !== 2 || self::$count == 0) {
                        self::runGame();
                    }else{
                        self::continueGame();
                    }
                    break;
                case 2:
                    //получить сокровище
                    if(self::$room == 1){
                        self::$mark += self::$count;
                        self::runGame();
                    }else{
                        self::continueGame();
                    }
                    break;
                case 3:
                    // стрелять
                    if(self::$room == 2 && self::$count > 0){
                        if(self::$time > 0){
                            self::$mark -= time() - self::$time;
                        }
                        self::$time = time();
                        $position = Room::$coordinates_let[self::$count - 1];
                        self::$gameField[$position[0]][$position[1]] = ' ';
                        self::$count--;
                    }
                    if(self::$count == 0){
                        self::$time = 0;
                    }
                    if(self::$mark <= 0){
                        self::gameOver(0);
                    }
                    self::continueGame();
                    break;
            }
            self::makeMove(!$isUserMove);
        }else{
            self::continueGame();
        }
    }

    private static function drawField() {
        self::clearScreen();
        self::showTitle();
        echo "\n";
        foreach (self::$gameField as $line) {
            foreach ($line as $cell) {
                echo "\e[102;82;1m $cell"; // белый на зелёном фоне
            }
            echo "\n";
        }
    }

    private static function gameOver($whoWin = -1) {
        sleep(1);

        self::clearScreen();

        if ($whoWin == -1) {
            echo <<<EOD
=========================================================
 игра окончена
=========================================================
EOD;
        }

        if ($whoWin == 0) {
            echo <<<EOD
=========================================================
 вы проиграли
=========================================================
EOD;
        }

        echo "\n Счёт : " . self::$mark;
        echo "\n Хотите играть ещё (Y/N)? : ";
        $userChoice =  strtolower(substr(fgets(STDIN), 0, 1));
        $userChoice == 'y' ? self::init(): exit();
    }

    private static function clearScreen() {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            popen('cls', 'w');
        } else {
            system("clear");
        }
    }

}

Game::init();
