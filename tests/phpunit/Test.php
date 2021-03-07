<?php

namespace App\Tests\PhpUnit;

include __DIR__ . "/../../vendor/autoload.php";
//include __DIR__ . "/../../bootstrap.php";

use PHPUnit\Framework\TestCase;
use HeadlessChromium\BrowserFactory;

class Test extends TestCase
{
    public function testMethod()
    {
        //$browserFactory = new BrowserFactory();
        $browserFactory = new BrowserFactory('chromium-browser');
        $browser = $browserFactory->createBrowser([
            "headless" => true,
            "noSandbox" => true,
        ]);

        try {
            $page = $browser->createPage();
            $page->navigate('http://127.0.0.1/admin')->waitForNavigation();

            $pageTitle = $page->evaluate('document.title')->getReturnValue();

            // screenshot - Say "Cheese"! 😄
            $page->screenshot()->saveToFile('/test.png');
            // pdf
            $page->pdf(['printBackground' => false])->saveToFile('/test.pdf');
            $this->assertEquals('Administrator', $pageTitle, 'Puslapio title nesutampa!');
        } finally {
            $browser->close();
        }
    }
/*
    public function provider()
    {
        return [
            'my named data' => [true],
            'my data'       => [true]
        ];
    }*/

}
