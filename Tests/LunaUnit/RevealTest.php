<?php

class LunaUnit_RevealTest extends LunaUnit_TestCase
{
	public function test__construct()
	{
		$object = new stdClass();
		$reveal = new LunaUnit_Reveal($object);
		$this->assertAttributeInstanceOf('LunaUnit_ReflectionClass', 'object', $reveal);
		$this->assertAttributeSame($object, 'originalObject', $reveal);
	}

	/**
	 * @expectedException InvalidArgumentException
	 * @return void
	 */
	public function test__construct_with_exception()
	{
		new LunaUnit_Reveal(1);
	}

	public function testAttr()
	{
		$className = 'class'. md5(uniqid());
		eval("class $className { protected \$foo = 'foo'; }");
		$object = new $className;
		$reveal = new LunaUnit_Reveal($object);
		$reveal->attr('foo', 'bar');
		$this->assertAttributeSame('bar', 'foo', $object);
	}

	public function testAttr_return_self()
	{
		$className = 'class'. md5(uniqid());
		eval("class $className { protected \$foo = 'foo'; }");
		$object = new $className;
		$reveal = new LunaUnit_Reveal($object);
		$actual = $reveal->attr('foo', 'bar');
		$this->assertSame($reveal, $actual);
	}

	public function testCall()
	{
		$className = 'class'. md5(uniqid());
		eval("class $className { protected function foo() {} }");
		$object = $this
			->getMockBuilder($className)
			->setMethods(array('foo'))
			->getMock();
		$object
			->expects($this->once())
			->method('foo');
		$reveal = new LunaUnit_Reveal($object);
		$reveal->call('foo');
	}

	public function testCall_with_arguments()
	{
		$className = 'class'. md5(uniqid());
		eval("class $className { protected function foo() {} }");
		$object = $this
			->getMockBuilder($className)
			->setMethods(array('foo'))
			->getMock();
		$object
			->expects($this->once())
			->method('foo')
			->with('param1', 'param2', 'param3');
		$reveal = new LunaUnit_Reveal($object);
		$reveal->call('foo', 'param1', 'param2', 'param3');
	}

	public function testCall_returns_result_of_method()
	{
		$result = 'result!!!!';

		$className = 'class'. md5(uniqid());
		eval("class $className { protected function foo() {} }");
		$object = $this
			->getMockBuilder($className)
			->setMethods(array('foo'))
			->getMock();
		$object
			->expects($this->once())
			->method('foo')
			->will($this->returnValue($result));
		$reveal = new LunaUnit_Reveal($object);
		$actual = $reveal->call('foo');
		$this->assertSame($result, $actual);
	}
}
