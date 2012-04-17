<?php

class LunaUnit_ReflectionClass extends ReflectionClass
{
	protected $klass = null;

	public function __construct($argument)
	{
		parent::__construct($argument);
		$this->klass = $argument;
	}

	/**
	 * @param string $name
	 * @return LunaUnit_ReflectionProperty
	 */
	public function property($name)
	{
		return new LunaUnit_ReflectionProperty($this->klass, $name);
	}

	/**
	 * @param string $name
	 * @return LunaUnit_ReflectionMethod
	 */
	public function method($name)
	{
		return new LunaUnit_ReflectionMethod($this->klass, $name);
	}
}
