## Игра - консольное приложение на PHP

Можно набрать как можно больше очков или проиграть если останется ноль.

Игрок перемещается из комнаты в комнату прямолинейно.

Комната может быть с препятствием, пустой или содержать сокровища.

Если в комнате есть сокровища, то их можно собрать - счёт увеличивается в зависимости от количества сокровищ.

Если в комнате препятствие, перед переходом в следующую комнату его необходимо разрушить.

Препятствие уменьшается, когда игрок наносит удар.

В комнате с препятствием каждую секунду отнимаются очки, когда игрок начал стрелять.

После каждого действия игрока рассчитывается количество очков.

В строке под игровым полем выводися количество очков и список действий, доступных на текущий момент.

Игра реализована с ипользованием ООП и шаблона проектирования строитель(для создания комнат).

На старте выдаётся некоторое количество.

В начале игры и при переходе в следующую комнату её вид выбирается случайным образом. 

Величина препятсявия или количество сокровищ также создаются случайным образом в заданном диапазоне.
