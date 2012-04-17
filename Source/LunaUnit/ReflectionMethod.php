<?php

class LunaUnit_ReflectionMethod extends ReflectionMethod
{
	protected $klass = null;

	/**
	 * @param string|object $class
	 * @param string $name
	 */
	public function __construct($class, $name)
	{
		$this->klass = $class;
		parent::__construct($class, $name);
	}

	/**
	 * @return $this
	 */
	public function publicize()
	{
		if ( $this->isPublic() === false )
		{
			$this->setAccessible(true);
		}

		return $this;
	}

	/**
	 * @param array $arguments
	 * @return mixed
	 */
	public function invokeArray(array $arguments)
	{
		array_unshift($arguments, $this->klass);
		return call_user_func_array(array($this, 'invoke'), $arguments);
	}
}
