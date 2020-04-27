<?php declare(strict_types = 1);

namespace Warengo\Enum;

use Warengo\Enum\Exceptions\InvalidArgumentException;
use Warengo\Enum\Storage\EnumStorage;

/**
 * @internal
 */
abstract class EnumStatic
{

	/** @var EnumStorage[] */
	private static array $storages = [];

	/** @var mixed[] */
	private static array $lists = [];

	/**
	 * @return string[]
	 */
	abstract protected static function getEnums(): array;

	final public static function createMapping(): EnumMapping {
		return new EnumMapping(static::class, self::getEnumsCached());
	}

	/**
	 * @param mixed[] $arguments
	 */
	final public static function __callStatic(string $name, array $arguments)
	{
		if ($name !== strtoupper($name)) {
			throw new InvalidArgumentException(sprintf('Called static class must be uppercase, %s given', $name));
		}

		return static::get($name);
	}

	/**
	 * @return static
	 */
	final public static function get(string $name)
	{
		$name = strtolower($name);
		$storage = self::getStorage();
		if (!$storage->has($name)) {
			if (!isset(self::getEnumsCached()[$name])) {
				throw new InvalidArgumentException(
					sprintf('Enum %s not exists in %s', strtoupper($name), static::class)
				);
			}

			$storage->set($name, new static($name));
		}

		return $storage->get($name);
	}

	/**
	 * @return string[]
	 */
	private static function getEnumsCached(): array
	{
		if (!isset(self::$lists[static::class])) {
			foreach (static::getEnums() as $value) {
				self::$lists[static::class][strtolower($value)] = true;
			}
		}

		return self::$lists[static::class];
	}

	private static function getStorage(): EnumStorage
	{
		if (!isset(self::$storages[static::class])) {
			self::$storages[static::class] = new EnumStorage(static::class);
		}

		return self::$storages[static::class];
	}

}
