<?php declare(strict_types = 1);

namespace Warengo\Tests;

use Warengo\Enum\Enum;

/**
 * @method static self GET_ENUM()
 */
class TestEnum extends Enum
{

	protected static function getEnums(): array
	{
		return [
			'get_enum',
		];
	}

}
