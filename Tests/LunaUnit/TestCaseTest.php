<?php

class LunaUnit_TestCaseTest extends LunaUnit_TestCase
{
	public function testReveal()
	{
		$object = new stdClass();
		$testCase = new LunaUnit_TestCaseTest();
		$actual = $testCase->reveal($object);
		$this->assertInstanceOf('LunaUnit_Reveal', $actual);
	}
}
