<?php declare(strict_types=1);

namespace Tests;

use Codeception\Test\Unit;
use Utilitte\Enum\Exceptions\EnumNotExistsException;
use Utilitte\Enum\Exceptions\InvalidArgumentException;
use Utilitte\Tests\TestEnum;

class EnumTest extends Unit
{

	public function testEnum()
	{
		$this->assertSame(TestEnum::GET_ENUM(), TestEnum::GET_ENUM());
		$this->assertEquals('get_enum', TestEnum::GET_ENUM()->value());
	}

	public function testInvalidCase()
	{
		$this->expectException(InvalidArgumentException::class);

		TestEnum::gET_ENUM();
	}

	public function testInvalidMethod()
	{
		$this->expectException(EnumNotExistsException::class);

		TestEnum::GET_ENUMS();
	}

}
