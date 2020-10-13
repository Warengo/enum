<?php declare(strict_types = 1);

namespace Utilitte\Enum\Storage;

use Utilitte\Enum\Enum;
use Utilitte\Enum\Exceptions\EnumNotExistsException;

final class EnumEntry
{

	private string $key;

	private string $value;

	private string $class;

	private bool $isset;

	/** @var callable */
	private $factory;

	private Enum $enum;

	public function __construct(string $key, string $value, string $class, bool $isset, callable $factory)
	{
		$this->key = $key;
		$this->value = $value;
		$this->isset = $isset;
		$this->factory = $factory;
		$this->class = $class;
	}

	public function getEnum(): Enum
	{
		if (!$this->isset) {
			throw new EnumNotExistsException($this->class, $this->key);
		}

		if (!isset($this->enum)) {
			$this->enum = ($this->factory)($this->value);
		}

		return $this->enum;
	}

}
