<?php

namespace App\Tests\PhpUnit;

//include __DIR__ . "/../../vendor/autoload.php";
//include __DIR__ . "/../../bootstrap.php";

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testMethod($data)
    {
        $this->assertTrue($data);
    }

    public function provider()
    {
        return [
            'my named data' => [true],
            'my data'       => [true]
        ];
    }
}