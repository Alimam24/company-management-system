<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('people')->insert([
            ['id'=>1,'FirstName'=>'Mariana','LastName'=>'Kuhic','NationalId'=>'64838770228','email'=>'demond.conroy@example.com','phone_num'=>null,'BirthDate'=>'1996-12-28','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>2,'FirstName'=>'Hilario','LastName'=>'Conn','NationalId'=>'64108511221','email'=>'santiago25@example.com','phone_num'=>null,'BirthDate'=>'1983-02-15','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>3,'FirstName'=>'Carolanne','LastName'=>'Predovic','NationalId'=>'51203074954','email'=>'lynn21@example.com','phone_num'=>null,'BirthDate'=>'1978-05-19','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>4,'FirstName'=>'Estell','LastName'=>'Rodriguez','NationalId'=>'40219324950','email'=>'moore.christelle@example.com','phone_num'=>null,'BirthDate'=>'1972-02-17','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>5,'FirstName'=>'Rodger','LastName'=>'Casper','NationalId'=>'93234585532','email'=>'gdurgan@example.org','phone_num'=>null,'BirthDate'=>'1981-03-13','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>6,'FirstName'=>'Abigayle','LastName'=>'Leannon','NationalId'=>'84453616825','email'=>'qhermann@example.com','phone_num'=>'(910) 739-1154','BirthDate'=>'2024-03-22','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>7,'FirstName'=>'Clement','LastName'=>'Ward','NationalId'=>'49425492989','email'=>'dietrich.yasmin@example.net','phone_num'=>'+1-540-972-2053','BirthDate'=>'2022-12-05','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>8,'FirstName'=>'Karley','LastName'=>'Williamson','NationalId'=>'04114616516','email'=>'krippin@example.org','phone_num'=>'+14798140497','BirthDate'=>'2024-08-12','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>9,'FirstName'=>'Garret','LastName'=>'Schroeder','NationalId'=>'59035878752','email'=>'conor.osinski@example.net','phone_num'=>'+1.931.266.3273','BirthDate'=>'2023-07-27','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>10,'FirstName'=>'Elroy','LastName'=>'Wiegand','NationalId'=>'51904620728','email'=>'boyer.jeramie@example.com','phone_num'=>null,'BirthDate'=>'2010-07-01','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>11,'FirstName'=>'Reed','LastName'=>'Gibson','NationalId'=>'50181551122','email'=>'jay07@example.com','phone_num'=>'318-758-2601','BirthDate'=>'2012-10-19','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>12,'FirstName'=>'Bernie','LastName'=>'Luettgen','NationalId'=>'98669203772','email'=>'pink.rippin@example.com','phone_num'=>'+1.860.621.7500','BirthDate'=>'2003-06-06','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>13,'FirstName'=>'Tyrel','LastName'=>'Christiansen','NationalId'=>'83883649103','email'=>'fay31@example.net','phone_num'=>null,'BirthDate'=>'1998-07-14','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>14,'FirstName'=>'Johnnie','LastName'=>'Daugherty','NationalId'=>'95199423174','email'=>'peggie32@example.org','phone_num'=>'1-804-725-6572','BirthDate'=>'1977-03-04','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>15,'FirstName'=>'Heber','LastName'=>'Koch','NationalId'=>'06053196029','email'=>'wfarrell@example.net','phone_num'=>'(859) 239-1239','BirthDate'=>'1991-02-15','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>16,'FirstName'=>'Robbie','LastName'=>'Nikolaus','NationalId'=>'36993058255','email'=>'melvina67@example.com','phone_num'=>null,'BirthDate'=>'2006-09-07','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>17,'FirstName'=>'Mckayla','LastName'=>'Pacocha','NationalId'=>'51629554576','email'=>'king.judd@example.net','phone_num'=>'323.380.8438','BirthDate'=>'2006-05-11','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>18,'FirstName'=>'Franz','LastName'=>'Hessel','NationalId'=>'24818114400','email'=>'okessler@example.org','phone_num'=>'1-743-236-0343','BirthDate'=>'1971-07-12','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>19,'FirstName'=>'Johanna','LastName'=>'Kassulke','NationalId'=>'50147324124','email'=>'cormier.jaquelin@example.net','phone_num'=>'+1.646.584.9015','BirthDate'=>'2002-08-03','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>20,'FirstName'=>'Delfina','LastName'=>'VonRueden','NationalId'=>'08198450101','email'=>'darian57@example.com','phone_num'=>null,'BirthDate'=>'1973-12-24','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>21,'FirstName'=>'Toby','LastName'=>'Larkin','NationalId'=>'38202280237','email'=>'cathryn12@example.org','phone_num'=>null,'BirthDate'=>'2013-10-15','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>22,'FirstName'=>'Aurore','LastName'=>'Kub','NationalId'=>'50078855844','email'=>'rosemary90@example.net','phone_num'=>null,'BirthDate'=>'2024-01-30','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>23,'FirstName'=>'Graham','LastName'=>'Harvey','NationalId'=>'79664406597','email'=>'abe14@example.net','phone_num'=>null,'BirthDate'=>'2016-03-13','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>24,'FirstName'=>'Reyes','LastName'=>'Kulas','NationalId'=>'42590079040','email'=>'volkman.jayne@example.com','phone_num'=>null,'BirthDate'=>'2016-09-14','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>25,'FirstName'=>'Ryder','LastName'=>'Adams','NationalId'=>'14341388764','email'=>'briana.greenholt@example.com','phone_num'=>null,'BirthDate'=>'1984-05-24','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>26,'FirstName'=>'Grover','LastName'=>'Schuppe','NationalId'=>'55606234361','email'=>'darrin04@example.com','phone_num'=>'847-603-5667','BirthDate'=>'1975-12-14','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>27,'FirstName'=>'Alf','LastName'=>'Strosin','NationalId'=>'17377565792','email'=>'harry.mann@example.net','phone_num'=>null,'BirthDate'=>'2014-01-27','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>28,'FirstName'=>'Cornell','LastName'=>'Ruecker','NationalId'=>'25609078889','email'=>'annetta04@example.com','phone_num'=>null,'BirthDate'=>'2004-07-18','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>29,'FirstName'=>'Nellie','LastName'=>'Hermann','NationalId'=>'31040757743','email'=>'lisette65@example.com','phone_num'=>'+18787307343','BirthDate'=>'1982-05-30','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
            ['id'=>30,'FirstName'=>'Hortense','LastName'=>'Effertz','NationalId'=>'65251020884','email'=>'nils55@example.com','phone_num'=>'989-493-7692','BirthDate'=>'2005-01-22','avatar_url'=>'avatars/profile.png','created_at'=>'2026-01-25 20:05:49','updated_at'=>'2026-01-25 20:05:49'],
        ]);
    }
}
