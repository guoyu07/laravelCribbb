<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/** 4. getting-started-with-testing-laravel-4-models ADD
	* Default preparation for each test
	*/
	public function setUp()
	{
		parent::setUp();
		$this->prepareForTests();
	}

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	/** 4. getting-started-with-testing-laravel-4-models ADD
	* Migrate the database
	*/
	private function prepareForTests()
	{
		Artisan::call('migrate');
	}

}
