<?php declare(strict_types = 1);

namespace Utilitte\Enum;

use Utilitte\Enum\Exceptions\InvalidArgumentException;
use Utilitte\Enum\Storage\EnumStorage;

abstract class Enum
{

	/** @var EnumStorage[] */
	private static array $storages = [];

	private string $value;

	final protected function __construct(string $value)
	{
		$this->value = $value;
	}

	public function value(): string
	{
		return $this->value;
	}

	/**
	 * @return string[]
	 */
	abstract protected static function getEnums(): array;

	/**
	 * @param mixed[] $arguments
	 */
	final public static function __callStatic(string $name, array $arguments)
	{
		if ($name !== strtoupper($name)) {
			throw new InvalidArgumentException(sprintf('Called static class must be uppercase, %s given', $name));
		}

		return self::getStorage()->getEntry($name)->getEnum();
	}

	private static function getStorage(): EnumStorage
	{
		if (!isset(self::$storages[static::class])) {
			self::$storages[static::class] = new EnumStorage(
				static::class,
				fn(string $value) => new static($value),
				new EnumMapping(static::getEnums())
			);
		}

		return self::$storages[static::class];
	}

	public function __toString(): string
	{
		return $this->value;
	}

}
