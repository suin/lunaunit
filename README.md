# LunaUnit: Simplify Your Test Code

LunaUnit is a extension of PHPUnit. You can write simplier test code with LunaUnit. 

## Features

* Revealing privacy of objects.

## Requirements

* PHP 5.3.0 or later

## Reference

### Revealing privacy

You can manipulate protected/private attributes of methods simply using ```reveal()```. 

```
<?php

class RevealingSample1
{
	protected $bar = 'the best word is BAR';

	public function getBar()
	{
		return $this->bar;
	}

	protected function _foo()
	{
		return 'Is it possible to call me?';
	}
}

class RevealingSample1Test extends LunaUnit_TestCase
{
	public function testGetBar()
	{
		$foo = new RevealingSample1();
		$this->reveal($foo)->attr('bar', 'the best word is FOO'); // Simple to manipulate!!
		$this->assertSame('the best word is FOO', $foo->getBar());
	}

	public function test_foo()
	{
		$foo = new RevealingSample1();
		$actual = $this->reveal($foo)->call('_foo'); // Simple to call!!
		$this->assertSame('Is it possible to call me?', $actual);
	}
}
```