<?php

namespace App;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverDimension;

Trait Extended {

    public function __construct() {
        $this->init();
        parent::__construct();
    }

    protected function init() {
        $this->host = $_ENV['SELENIUM_HOST'];

        if ( $_ENV['BROWSER'] === 'chrome' ) {
            $chromeOptions = new ChromeOptions();
            $chromeOptions->addArguments(['--headless']);
            //$chromeOptions->addArguments(['--headless', '--no-sandbox', '--disable-gpu']);

            $capabilities = DesiredCapabilities::chrome();
            $capabilities->setCapability(ChromeOptions::CAPABILITY, $chromeOptions);
        } else {
            $capabilities = DesiredCapabilities::firefox();
            $capabilities->setCapability('moz:firefoxOptions', ['args' => ['-headless']]);
        }

        $capabilities->setCapability('acceptSslCerts', false);

        $this->driver =  RemoteWebDriver::create($this->host, $capabilities);;
        $this->driver
            ->manage()
            ->window()
            ->setSize( new WebDriverDimension( $_ENV['WINDOW_WIDTH'], $_ENV['WINDOW_HEIGHT'] ) )
		;
    }

    public function get(string $url) {
        $this->driver->get( $_ENV['WEBSITE_URL'] . $url);
    }

    public function takeScreenshot(string $filename) {
        $this
            ->driver
            ->takeScreenshot( __DIR__ . "/../" . $_ENV['SCREENSHOT_SAVE_PATH'] . "/" . $filename)
        ;
    }

    public function find(string $cssSelector) {
        return $this
            ->driver
            ->findElement(WebDriverBy::cssSelector($cssSelector))
        ;
    }

    public function fillInput(string $cssSelector, string $inputValue) {
        $this
            ->driver
            ->findElement(WebDriverBy::cssSelector($cssSelector))
            ->sendKeys($inputValue)
        ;
    }

    public function click(string $cssSelector) {
        $this
            ->driver
            ->findElement(WebDriverBy::cssSelector($cssSelector))
            ->click()
        ;
    }

    public function __destruct () {
        if ( !empty($this->driver) ) {
            $this->driver->quit();
        }
    }

}