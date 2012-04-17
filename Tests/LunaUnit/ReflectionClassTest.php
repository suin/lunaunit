<?php

class LunaUnit_ReflectionClassTest extends LunaUnit_TestCase
{
	public function test__construct()
	{
		$object = new stdClass();
		$class = new LunaUnit_ReflectionClass($object);
		$this->assertAttributeSame($object, 'klass', $class);
	}

	public function testProperty()
	{
		$object = new stdClass();
		$object->foo = 'foo';
		$class = new LunaUnit_ReflectionClass($object);
		$actual = $class->property('foo');
		$this->assertInstanceOf('LunaUnit_ReflectionProperty', $actual);
	}

	public function testMethod()
	{
		$object = $this
			->getMockBuilder('stdClass')
			->setMethods(array('foo'))
			->getMock();

		$class = new LunaUnit_ReflectionClass($object);
		$actual = $class->method('foo');
		$this->assertInstanceOf('LunaUnit_ReflectionMethod', $actual);
	}
}
