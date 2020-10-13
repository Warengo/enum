<?php declare(strict_types = 1);

namespace Utilitte\Enum\Storage;

use Utilitte\Enum\Enum;
use Utilitte\Enum\EnumMapping;
use Utilitte\Enum\Exceptions\InvalidArgumentException;
use Utilitte\Enum\Exceptions\UnexpectedValueException;

class EnumStorage
{

	/** @var Enum[] */
	private array $storage = [];

	/** @var EnumEntry[] */
	private array $entries = [];

	private string $class;

	/** @var callable */
	private $factory;

	private EnumMapping $mapping;

	public function __construct(string $class, callable $factory, EnumMapping $mapping)
	{
		$this->class = $class;
		$this->factory = $factory;
		$this->mapping = $mapping;
	}

	public function getEntry(string $name): EnumEntry
	{
		$key = strtoupper($name);
		$value = strtolower($name);

		if (!isset($this->entries[$key])) {
			$this->entries[$key] = new EnumEntry($key, $value, $this->class, $this->mapping->has($key), $this->factory);
		}

		return $this->entries[$key];
	}

	public function has(string $name): bool
	{
		return isset($this->storage[$name]);
	}

	public function get(string $name): Enum
	{
		if (!isset($this->storage[$name])) {
			throw new InvalidArgumentException(sprintf('%s not exists in enum storage', $name));
		}

		return $this->storage[$name];
	}

	public function set(string $name, Enum $enum): void
	{
		if (!$enum instanceof $this->class) {
			throw new UnexpectedValueException(
				sprintf('Value must be instance of %s, %s given', $this->class, get_class($enum))
			);
		}

		$this->storage[$name] = $enum;
	}

}
