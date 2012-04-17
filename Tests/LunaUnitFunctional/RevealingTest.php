<?php

class LunaUnitFunctional_Revealing
{
	protected $foo = 'foo';
	protected $baz = 'baz';

	protected function _returnSelf()
	{
		return $this;
	}

	protected function _returnFoo()
	{
		return $this->foo;
	}

	protected function _setFoo($foo)
	{
		$this->foo = $foo;
	}
}

class LunaUnitFunctional_RevealingTest extends LunaUnit_TestCase
{
	public function testCallProtectedMethod()
	{
		$object = new LunaUnitFunctional_Revealing();
		$actual = $this->reveal($object)->call('_returnSelf');
		$this->assertSame($object, $actual);
	}

	public function testUpdateProtectedAttribute()
	{
		$object = new LunaUnitFunctional_Revealing();
		$actual = $this->reveal($object)->attr('foo', 'foobar')->call('_returnFoo');
		$this->assertSame('foobar', $actual);
	}

	public function testUpdateSomeAttributes()
	{
		$object = new LunaUnitFunctional_Revealing();
		$this
			->reveal($object)
			->attr('foo', 'A')
			->attr('baz', 'B');

		$this->assertAttributeSame('A', 'foo', $object);
		$this->assertAttributeSame('B', 'baz', $object);
	}
}
