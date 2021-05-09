<?php

use Phinx\Seed\AbstractSeed;

class AdminSeeder extends AbstractSeed
{
    public function run()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
        $dotenv->load();

        echo $_ENV['WEB_ADMINISTRATOR_PASSWORD'];

        $this
            ->table('administrators')
            ->insert([
                        [
                            'username' => $_ENV["WEB_ADMINISTRATOR_USERNAME"],
                            'email' => $_ENV['WEB_ADMINISTRATOR_EMAIL'],
                            'password_hash' => password_hash($_ENV['WEB_ADMINISTRATOR_PASSWORD'], PASSWORD_BCRYPT, ['cost' => 12]),
                            'enabled' => 1,
                            'access' =>
                                json_encode([
                                    "App\Admin\Controller\DashboardController" => ["index"],
                                    "App\Admin\Controller\ArticleController" => ["list", "view"],
                                ])
                        ]
                    ]
            )
            ->save()
        ;
    }
}
