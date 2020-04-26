<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Lavary\Menu\Menu;
use Gate;


class AdminController extends Controller
{

    protected $title = 'Адміністрування: ';

    public function getMenu()
    {
        return \Menu::make('adminMenu', function ($menu){
            $attr = ['class' => 'nav-link active'];
            if(Gate::allows('View_Admin')) {
                $menu->add('Підключення шкіл', ['route' => 'schools.index', 'class' => 'nav-item'])->link->attr($attr);
                $menu->add('Користувачі', ['route' => 'users.index', 'class' => 'nav-item'])->link->attr($attr);
                $menu->add('Ролі та дозволи', ['route' => 'roles.index', 'class' => 'nav-item'])->link->attr($attr);
            }
            if(Gate::allows('View_School_Admin')) {
                $menu->add('Адмініструвати школи', ['route' => 'school.index', 'class' => 'nav-item'])->link->attr($attr);
            }
            if(Gate::allows('View_Cook')) {
                $menu->add('Комбінат харчування', ['route' => 'courses.index', 'class' => 'nav-item'])->link->attr($attr);
                $menu->add('Комплексні обіди', ['route' => 'lunches.index', 'class' => 'nav-item'])->link->attr($attr);
            }
        });
    }
    
}
