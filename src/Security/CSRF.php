<?php declare(strict_types = 1);

namespace App\Security;

class CSRF
{
    private string $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    public function generate(int $strength = 32): string
    {
        $input_length = strlen($this->permitted_chars);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $this->permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        
        $_SESSION['CSRF_TOKEN'] = $random_string;
        
        return $_SESSION['CSRF_TOKEN'];
    }
    
    public function getToken(): string
    {
        return  $_SESSION['CSRF_TOKEN'] ?? $this->generate();
    }
}
