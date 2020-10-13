<?php declare(strict_types = 1);

namespace Utilitte\Enum\Exceptions;

use Exception;

class EnumNotExistsException extends Exception
{

	public function __construct(string $class, string $key)
	{
		parent::__construct(sprintf('Enum %s::%s not exists', $class, $key));
	}

}
