@if(count($schools) == 0)
    @dump($schools)
    Здесь мы нарисуем кнопку импорта школ
@else
    А здесь выведем таблицу школ
@endif
