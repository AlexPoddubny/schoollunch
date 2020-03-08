<?php
    
    
    namespace App\Providers;
    
    
    use App\Helpers\Facades\ImportSchools;
    use Illuminate\Support\ServiceProvider;

    class ImportSchoolsServiceProvider
        extends ServiceProvider
    {
        public function register()
        {
            App::bind('importschools', function (){
                return new ImportSchools();
            });
        }
    }
