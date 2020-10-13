<?php declare(strict_types = 1);

namespace Utilitte\Enum;

abstract class Enum extends EnumStatic
{

	private string $value;

	final protected function __construct(string $value)
	{
		$this->value = $value;
	}

	public function value(): string
	{
		return $this->value;
	}

	public function __toString(): string
	{
		return $this->value;
	}

}
