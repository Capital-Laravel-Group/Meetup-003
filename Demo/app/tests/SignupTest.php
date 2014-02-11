<?php

class SignupTest extends TestCase {

	private $driver;

 	public function setUp()
    {
    	parent::setup();

    	$desiredCapabilities = new SeleniumClient\DesiredCapabilities('chrome');
        $this->driver = new SeleniumClient\WebDriver($desiredCapabilities);
        $this->driver->get('http://localhost:8000'); // Frontpage
    }

	public function testCheckboxValidation()
	{
		// Fill out form
        $this->driver->findElementById('email')->sendKeys('me@codemonkey.io');
        $this->driver->findElementById('name')->sendKeys('Mathias Hansen');

		// Click "Sign up" button
        $this->driver->findElementById('submit')->click();
        sleep(2);

        // Make sure that error messages are displayed
        $this->assertTrue($this->driver->findElementByClassName('text-danger')->isDisplayed());

        $this->driver->closeCurrentWindow();
	}

	public function testFullSignup()
	{
		// Fill out form
        $this->driver->findElementById('email')->sendKeys('me@codemonkey.io');
        $this->driver->findElementById('name')->sendKeys('Mathias Hansen');
        $this->driver->findElementById('accept')->click();

		// Click "Sign up" button
        $this->driver->findElementById('submit')->click();
        sleep(2);

        // Make sure that success message is shown
        $this->assertEquals('Thank you for signing up', $this->driver->findElementByTagName('h1')->getText());

        $this->driver->closeCurrentWindow();
	}

}