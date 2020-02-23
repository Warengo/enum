Type safe enums

## Getting started

Create enum class
```php
/**
 * @method static self ENGLAND() 
 * @method static self USA() 
 */
class CountryEnum 
{
    protected static function getEnums(): array
    {
        return ['england', 'usa'];
    }

}
```

## Usage

static method must be always uppercase
```php
assert(CountryEnum::USA() === CountryEnum::USA());

function country(CountryEnum $country): string {
    return $country->value();
}

assert(country(CountryEnum::USA()) === 'usa');
```

convert enum value to object:
```php 
assert(CountryEnum::get('usa') === CountryEnum::USA());
```