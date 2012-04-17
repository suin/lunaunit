<?php

class LunaUnit_ReflectionPropertyTest extends LunaUnit_TestCase
{
	public function test__construct()
	{
		$className = __FUNCTION__;
		eval("class $className { public \$foo = 'foo'; }");
		$object = new $className;
		$property = new LunaUnit_ReflectionProperty($object, 'foo');
		$this->assertAttributeSame($object, 'klass', $property);
	}

	public function testPublicize()
	{
		$className = __FUNCTION__;
		eval("class $className { public \$foo = 'foo'; }");
		$object = new $className;
		$property = new LunaUnit_ReflectionProperty($object, 'foo');
		$property->publicize();
		$this->assertSame('foo', $property->getValue($object));
	}

	public function testPublicize_with_protected_property()
	{
		$className = __FUNCTION__;
		eval("class $className { protected \$foo = 'foo'; }");
		$object = new $className;
		$property = new LunaUnit_ReflectionProperty($object, 'foo');
		$property->publicize();
		$this->assertSame('foo', $property->getValue($object));
	}

	public function testPublicize_with_private_property()
	{
		$className = __FUNCTION__;
		eval("class $className { private \$foo = 'foo'; }");
		$object = new $className;
		$property = new LunaUnit_ReflectionProperty($object, 'foo');
		$property->publicize();
		$this->assertSame('foo', $property->getValue($object));
	}

	public function testSetValue()
	{
		$className = __FUNCTION__;
		eval("class $className { public \$foo = 'foo'; }");
		$object = new $className;
		$property = new LunaUnit_ReflectionProperty($object, 'foo');
		$property->setValue('bar');
		$this->assertSame('bar', $property->getValue($object));
	}

	public function testSetValue_with_first_argument_is_class_name()
	{
		$className = __FUNCTION__;
		eval("class $className { public static \$foo = 'foo'; }");
		$property = new LunaUnit_ReflectionProperty($className, 'foo');
		$property->setValue('bar');
		$this->assertSame('bar', $property->getValue());
	}

	public function testSetValue_with_static_property_of_instance()
	{
		$className = __FUNCTION__;
		eval("class $className { public static \$foo = 'foo'; }");
		$object = new $className;
		$property = new LunaUnit_ReflectionProperty($object, 'foo');
		$property->setValue('bar');
		$this->assertSame('bar', $className::$foo);
	}
}
