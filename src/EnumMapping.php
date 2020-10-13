<?php declare(strict_types = 1);

namespace Utilitte\Enum;

final class EnumMapping
{

	/** @var string[] */
	private array $mapping = [];

	private string $class;

	/**
	 * @param bool[] $mapping
	 */
	public function __construct(string $class, array $mapping)
	{
		$this->class = $class;
		foreach ($mapping as $key => $bool) {
			$this->mapping[strtoupper($key)] = $key;
		}
	}

	public function getClass(): string
	{
		return $this->class;
	}

	public function callableGetter(): callable
	{
		return [$this->getClass(), 'get'];
	}

	/**
	 * @return string[]
	 */
	public function getMapping(): array
	{
		return $this->mapping;
	}

}
