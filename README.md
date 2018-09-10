## Игра - консольное приложение на PHP

#### Игра реализована с ипользованием ООП и шаблона проектирования строитель(для создания комнат).

Можно набрать как можно больше очков или проиграть если останется ноль.

Игрок перемещается из комнаты в комнату прямолинейно.

Комната может быть с препятствием, пустой или содержать сокровища.

Если в комнате есть сокровища, то их можно собрать - счёт увеличивается в зависимости от количества сокровищ.

Если в комнате препятствие, перед переходом в следующую комнату его необходимо разрушить.

Препятствие уменьшается, когда игрок наносит удар.

В комнате с препятствием каждую секунду отнимаются очки, когда игрок начал стрелять.

После каждого действия игрока рассчитывается количество очков.

В строке под игровым полем выводися количество очков и список действий, доступных на текущий момент.

На старте выдаётся некоторое количество очков.

В начале игры и при переходе в следующую комнату её вид выбирается случайным образом. 

Величина препятсявия или количество сокровищ также создаются случайным образом в заданном диапазоне.

#### Для запуска в консоли перейти в папку с файлом и выполить команду:
```sh
$ php index.php
```
