<h1>Тестова система онлайн-меню шкільного харчування</h1>
<div>
    Для перегляду поточного меню у зареєстрованих у системі школах оберіть, будь ласка, школу зі списку:
    {!! $schools !!}
</div>
<div>
    Для постійного нагляду за шкільним харчуванням своїх дітей, будь ласка, <a href="{{ route('register') }}">зареєструйтесь у системі</a> та додайте їх до списку спостереження.
</div>
<div>Також ви можете переглянути <a href="{{route('course.index')}}">повне меню страв</a>, які готує комбінат шкільного харчування.</div>
