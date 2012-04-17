<?php

class PHPVersion_VersionTest extends PHPUnit_Framework_TestCase
{
	public function testVersion()
	{
		$this->assertTrue(version_compare(PHP_VERSION, '5.3.0', '>='), "PHP version must be greater than 5.3 or equal to.");
	}
}
