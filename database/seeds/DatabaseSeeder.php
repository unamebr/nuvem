<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin  admin',
            'email' => 'admin@nuvem.com',
            'password' => bcrypt('123456'),
            'phone' => '8799998888',
            'user_type' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('maquinas')->insert([
            'cpu_utilizavel' => 30,
            'ram_utilizavel' => 1024,
            'hashcode' => '$2y$10$meLLu4qZwa9GXlGSB9/KLu/KDT.ayLqTAFKbtxP/qQpieyFe2.wUW',
            'user_id' => 1,
            'ip' => '1.1.1.1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('atividade_maquinas')->insert([
            'hashcode_maquina' => '$2y$10$meLLu4qZwa9GXlGSB9/KLu/KDT.ayLqTAFKbtxP/qQpieyFe2.wUW',
            'dataHoraInicio' => now(),
            'last_notification' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // DB::table('images')->insert([
        //     'name' => 'Nginx:latest',
        //     'description' => 'Nginx (pronounced "engine-x") is an open source
        //                       reverse proxy server for HTTP, HTTPS, SMTP, POP3, and IMAP
        //                       protocols, as well as a load balancer, HTTP cache, and a web
        //                       server (origin server).',
        //     'fromImage' => 'nginx',
        //     'tag' => 'latest',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('images')->insert([
        //     'name' => 'Wordpress/MySQL:11.0',
        //     'description' => 'Image com worpress e MySQL instalados.',
        //     'fromImage' => 'gabriel31415/wordpressmysql',
        //     'tag' => '11.0',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        DB::table('images')->insert([
            'name' => 'Wordpress/MySQL:12.0',
            'description' => 'Image com worpress e MySQL instalados.',
            'fromImage' => 'gabriel31415/wordpressmysql',
            'tag' => '12.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('images')->insert([
            'name' => 'Wordpress/MySQL:13.0',
            'description' => 'Image com worpress e MySQL instalados.',
            'fromImage' => 'gabriel31415/wordpressmysql',
            'tag' => '13.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('images')->insert([
            'name' => 'Wordpress/MySQL:14.0',
            'description' => 'Image com worpress e MySQL instalados.',
            'fromImage' => 'gabriel31415/wordpressmysql',
            'tag' => '14.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('images')->insert([
            'name' => 'Wordpress/MySQL:17.0',
            'description' => 'Image com worpress e MySQL instalados.',
            'fromImage' => 'gabriel31415/wordpressmysql',
            'tag' => '17.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('images')->insert([
            'name' => 'gabriel31415/joomlamariadb:2.0',
            'description' => 'Image com joomla e MariaDB instalados.',
            'fromImage' => 'gabriel31415/joomlamariadb',
            'tag' => '2.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('images')->insert([
            'name' => 'gabriel31415/drupalmariadb:1.0',
            'description' => 'Image com Drupal e MariaDB instalados.',
            'fromImage' => 'gabriel31415/drupalmariadb',
            'tag' => '1.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call([UsersTableSeeder::class]);
    }
}
