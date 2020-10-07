<?php
    
    /** @var \Illuminate\Database\Eloquent\Factory $factory */
    
    use App\Student;
    use Faker\Generator as Faker;
    use Illuminate\Support\Arr;
    
    $factory->define(Student::class, function (Faker $faker) {
        $sex = Arr::random(['male', 'female']);
        return [
            'fullname' => $faker->firstName($sex) . ' ' . $faker->lastName($sex),
            'privilege' => (bool)random_int(0, 1)
        ];
    });
