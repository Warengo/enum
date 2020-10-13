<?php declare(strict_types = 1);

namespace Utilitte\Enum;

final class EnumMapping
{

	/** @var bool[] */
	private array $mapping = [];

	/**
	 * @param string[] $mapping
	 */
	public function __construct(array $mapping)
	{
		foreach ($mapping as $key) {
			$this->mapping[strtoupper($key)] = true;
		}
	}

	public function has(string $key): bool
	{
		return isset($this->mapping[$key]);
	}

}
