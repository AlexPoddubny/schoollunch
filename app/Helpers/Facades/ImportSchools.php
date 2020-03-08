<?php
    
    
    namespace App\Helpers\Facades;
    
    
    use Illuminate\Support\Facades\Facade;

    class ImportSchools extends Facade
    {
        
        const LINK = 'http://kramportal.info/Schools.html';
        
        public static function getFacadeAccessor()
        {
            return 'importschools';
        }
    
        public static function import()
        {
            $schools = [];
            $arr = explode('<tr class="spravka"',
                mb_convert_encoding(file_get_contents(static::LINK), 'UTF-8', 'CP1251'));
            unset($arr[0]);
            unset($arr[1]);
            foreach ($arr as $item){
                $row = explode('<td style', $item);
                $schools[] = strip_tags(between('<b>', '</b>', $row[1]));
            }
            return $schools;
        }
        
    }
