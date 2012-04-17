<?php

class LunaUnit_ReflectionProperty extends ReflectionProperty
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
	 * @param mixed $value
	 * @return $this|void
	 */
	public function setValue($value)
	{
		parent::setValue($this->klass, $value);
		return $this;
	}
}
