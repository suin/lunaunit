<?php

class LunaUnit_TestCase extends PHPUnit_Framework_TestCase
                        implements LunaUnit_AssertInterface
{
	/**
	 * Return new Reveal object.
	 * @param object $object
	 * @return LunaUnit_Reveal
	 */
	protected function reveal($object)
	{
		return new LunaUnit_Reveal($object);
	}
}
