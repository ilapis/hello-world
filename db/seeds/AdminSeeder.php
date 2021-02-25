<?php

use Phinx\Seed\AbstractSeed;

class AdminSeeder extends AbstractSeed
{
    public function run()
    {
        $this
            ->table('administrators')
            ->insert([
                        [
                            'username' => 'demo',
                            'email' => 'demo@somewebsite.com',
                            'password_hash' => password_hash("demo", PASSWORD_BCRYPT, ['cost' => 12]),
                            'enabled' => 1,
                            'access' =>
                                json_encode([
                                    "App\Admin\Controller\DashboardController" => ["index"],
                                    "App\Admin\Controller\ArticleController" => ["list", "view"],
                                ])
                        ],
                        [
                        'username' => 'admin_demo',
                            'email' => 'admin@somewebsite.com',
                            'password_hash' => password_hash("admin_demo", PASSWORD_BCRYPT, ['cost' => 12]),
                            'enabled' => 1,
                            'access' =>
                                json_encode([
                                    "App\Admin\Controller\DashboardController" => ["index"],
                                    "App\Admin\Controller\ArticleController" => ["list", "view"],
                                    "App\Admin\Controller\AdminMenuController" => ["list", "view"],
                                ])
                        ]
                    ]
            )
            ->save()
        ;
    }
}
