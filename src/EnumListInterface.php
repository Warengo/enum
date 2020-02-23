<?php declare(strict_types = 1);

namespace Warengo\Enum;

interface EnumListInterface
{

	public function has(string $name): bool;

	public function get(string $name): string;

}