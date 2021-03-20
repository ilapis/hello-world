<?php

namespace Facebook\WebDriver;

include __DIR__ . "/../vendor/autoload.php";
include __DIR__ . "/../bootstrap.php";

use App\Extended;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    use Extended;

    public function testLogin()
    {
        $this->get($_ENV['ADMIN_LOGIN_PAGE']);

        $login_button = $this->find("button[type='submit']");

        $this->assertEquals('Submit', $login_button->getText());

        $this->fillInput("input[name='username']", $_ENV['ADMIN_USERNAME']);
        $this->fillInput("input[name='password']", $_ENV['ADMIN_PASSWORD']);

        $this->takeScreenshot('1_login_page.png');

        $this->click("button[type='submit']");
		
		$driver = $this->driver;
		
		$driver->wait()->until(
			function () use ($driver) {
				$elements1 = $driver->findElements(WebDriverBy::cssSelector('.sidebar'));
				return count($elements1) > 0;
			},
			'Error locating at least one of the elements'
		);

//sleep(1);
        try {
            //$agent_status = $this->driver->find("#navbar-agent-status");
        } catch (\Exception $e) {

        } finally {
            $this->takeScreenshot('2_after_login_page.png');
            //$this->assertIsString($agent_status->getText());
        }
    }
}
