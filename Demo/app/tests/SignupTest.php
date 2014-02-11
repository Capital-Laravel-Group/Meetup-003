<?php
use SeleniumClient\By;

class SignupTest extends TestCase {

	private $driver;
    private $facebookUser;

 	public function setUp()
    {
    	parent::setup();

    	$desiredCapabilities = new SeleniumClient\DesiredCapabilities('chrome');
        $this->driver = new SeleniumClient\WebDriver($desiredCapabilities);
        $this->driver->get('http://localhost:8000'); // Frontpage

        // Put anything you like here
        $this->facebookUser = (object)[
            'email' => 'joeaverage325@gmail.com',
            'password' => 'joeaverage325'
        ];
    }

    /**
     * Test that an error message is displayed if the checkbox
     * have not been checked
     */
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

    /**
     * Test that a full signup works
     */
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

    /**
     * Test that autofill with Facebook works
     */
    public function testAutofillWithFacebook()
    {
        // Click "Autofill with Facebook"
        $this->driver->findElementByClassName('btn-facebook')->click();
        sleep(3); // Wait for popup window to open

        // Switch to popup window
        $handles = $this->driver->getCurrentWindowHandles();
        $this->driver->switchTo()->getWindow($handles[count($handles) - 1])->waitForElementUntilIsPresent(By::id('email'), 10);

        // Fill out Facebook login fields
        $this->driver->findElementById('email')->sendKeys($this->facebookUser->email);
        $this->driver->findElementById('pass')->sendKeys($this->facebookUser->password);
        $this->driver->findElementByCssSelector('input[type=submit]')->click();
        sleep(3); // Wait for window to close

        // Switch back to main window
        $this->driver->switchTo()->getWindow($handles[0])->waitForElementUntilIsPresent(By::id('email'), 10);

        // Ensure that fields has been filled out
        $this->assertNotEmpty($this->driver->findElementById('email')->getAttribute('value'));
        $this->assertNotEmpty($this->driver->findElementById('name')->getAttribute('value'));
    }

}