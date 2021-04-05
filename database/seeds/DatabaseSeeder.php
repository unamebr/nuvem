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
            'user_name' => 'admin',
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

        DB::table('images')->insert([
            'name' => 'Nginx:latest',
            'photo' => 'imagens/nginx.png',
            'website' => 'https://www.nginx.com/',
            'description' => 'Nginx (pronounced "engine-x") is an open source
                              reverse proxy server for HTTP, HTTPS, SMTP, POP3, and IMAP
                              protocols, as well as a load balancer, HTTP cache, and a web
                              server (origin server).',
            'fromImage' => 'nginx',
            'tag' => 'latest',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // DB::table('images')->insert([
        //     'name' => 'Wordpress/MySQL:11.0',
        //     'description' => 'Image com worpress e MySQL instalados.',
        //     'fromImage' => 'gabriel31415/wordpressmysql',
        //     'tag' => '11.0',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);


        DB::table('images')->insert([
            'name' => 'Wordpress',
            'photo' => 'imagens/wordpress.png',
            'website' => 'https://wordpress.com/pt-br/',
            'description' => 'WordPress é a mais popular  plataforma de publicação online. É open source, e utilizada por mais de 20% da Web.',
            'fromImage' => 'gabriel31415/wordpressmysql',
            'tag' => '17.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
        DB::table('images')->insert([
            'name' => 'Drupal',
            'photo' => 'imagens/drupal1.jpeg',
            'website' => 'https://www.drupal.org/',
            'description' => 'Drupal é um software de gerenciamento de conteúdo. É usado para fazer muitos dos sites e aplicativos que você usa todos os dias.',
            'fromImage' => 'gabriel31415/drupalmariadb',
            'tag' => '2.0',
            'created_at' => now(),
            'updated_at' => now(),
            ]);
            
        DB::table('images')->insert([
            'name' => 'Joomla!',
            'photo' => 'imagens/joomla.png',
            'website' => 'https://www.joomla.org/',
            'description' => 'Joomla! é um sistema de gerenciamento de conteúdo (CMS) gratuito e de código aberto para publicação de conteúdo da web. ',
            'fromImage' => 'gabriel31415/joomlamariadb',
            'tag' => '3.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
            $this->call([UsersTableSeeder::class]);
    }
}
