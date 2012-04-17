<?php

class LunaUnit_ReflectionMethodTest extends LunaUnit_TestCase
{
	public function test__construct()
	{
		$className = 'dummy'.md5(uniqid());
		eval("class $className { public function foo(){} }");
		$object = new $className();
		$method = new LunaUnit_ReflectionMethod($object, 'foo');
		$this->assertAttributeSame($object, 'klass', $method);
	}
	
	public function testPublicize()
	{
		$className = 'dummy'.md5(uniqid());
		eval("class $className { public function foo(){} }");
		$object = $this
			->getMockBuilder($className)
			->setMethods(array('foo'))
			->getMock();
		$object
			->expects($this->once())
			->method('foo');
		$method = new LunaUnit_ReflectionMethod($object, 'foo');
		$method->publicize();
		$method->invoke($object);
	}

	public function testPublicize_with_protected_method()
	{
		$className = 'dummy'.md5(uniqid());
		eval("class $className { protected function foo(){} }");
		$object = $this
			->getMockBuilder($className)
			->setMethods(array('foo'))
			->getMock();
		$object
			->expects($this->once())
			->method('foo');
		$method = new LunaUnit_ReflectionMethod($object, 'foo');
		$method->publicize();
		$method->invoke($object);
	}

	public function testPublicize_with_private_method()
	{
		$className = 'dummy'.md5(uniqid());
		eval("class $className { private function foo(){} }");
		$object = $this
			->getMockBuilder($className)
			->setMethods(array('foo'))
			->getMock();
		$object
			->expects($this->once())
			->method('foo');
		$method = new LunaUnit_ReflectionMethod($object, 'foo');
		$method->publicize();
		$method->invoke($object);
	}

	public function testPublicize_with_private_static_method()
	{
		$className = 'dummy'.md5(uniqid());
		eval("class $className { private static function foo(){ return 'called!'; } }");
		$method = new LunaUnit_ReflectionMethod($className, 'foo');
		$method->publicize();
		$actual = $method->invoke($className);
		$this->assertSame('called!', $actual);
	}

	public function testInvokeArray()
	{
		$className = 'dummy'.md5(uniqid());
		eval("class $className { public function foo(){} }");
		$object = $this
			->getMockBuilder($className)
			->setMethods(array('foo'))
			->getMock();
		$object
			->expects($this->once())
			->method('foo')
			->with('param1', 'param2', 'param3');
		$method = new LunaUnit_ReflectionMethod($object, 'foo');
		$method->invokeArray(array('param1', 'param2', 'param3'));
	}

	public function testInvokeArray_returns_result_of_method()
	{
		$result = uniqid();

		$className = 'dummy'.md5(uniqid());
		eval("class $className { public function foo(){} }");
		$object = $this
			->getMockBuilder($className)
			->setMethods(array('foo'))
			->getMock();
		$object
			->expects($this->once())
			->method('foo')
			->will($this->returnValue($result));
		$method = new LunaUnit_ReflectionMethod($object, 'foo');
		$actual = $method->invokeArray(array());
		$this->assertSame($result, $actual);
	}
}
