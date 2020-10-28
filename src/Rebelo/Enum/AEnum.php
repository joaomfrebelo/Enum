<?php

/**
 * Copyright (c) 2019 João M F Rebelo
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */
declare(strict_types=1);

namespace Rebelo\Enum;

/**
 * The abstract class for Enumerations
 *
 * Based on examples in
 * @link http://stackoverflow.com/questions/254514/php-and-enumerations
 *
 * @author João Rebelo
 * @since 1.0.0
 */
abstract class AEnum
{

    /**
     *
     * The value initialized in enumertion
     *
     * @var Mixed
     * @since 1.0.0
     */
    protected $value = null;

    /**
     *
     * @param Mixed $value
     * @throws EnumException
     * @since 1.0.0
     */
    public function __construct($value)
    {
        if (\is_scalar($value))
        {
            if (static::isValidValue($value))
            {
                $this->value = $value;
                return;
            }
            elseif (static::isValidName($value))
            {
                $this->value = static::getValue((string) $value);
                return;
            }
        }
        throw new EnumException("Value in Enum class " . \get_called_class()
            . " is not valid");
    }

    /**
     * Cache of constants
     * @var array<string, array<int, string>>|null
     * @since 1.0.0
     */
    protected static $constCacheArray = null;

    /**
     *
     * Get constants
     *
     * @return string[]
     * @since 1.0.0
     */
    protected static function getConstants(): array
    {
        if (static::$constCacheArray === null)
        {
            static::$constCacheArray = array();
        }

        $calledClass = \get_called_class();
        if (!\array_key_exists($calledClass, static::$constCacheArray))
        {
            $reflect                               = new \ReflectionClass($calledClass);
            static::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return static::$constCacheArray[$calledClass];
    }

    /**
     *  Verify if the name existe
     * (Verify if the const name exist)
     *
     * @param  mixed $name
     * @param  bool  $strict
     * @return bool
     * @since 1.0.0
     */
    public static function isValidName($name, bool $strict = false): bool
    {
        $constants = static::getConstants();

        if ($strict)
        {
            return \array_key_exists($name, $constants);
        }

        $keys = \array_map('strtolower', array_keys($constants));
        return \in_array(strtolower($name), $keys);
    }

    /**
     * Verify if the value exist in any constant
     *
     * @param  mixed $value
     * @param  bool  $strict
     * @return bool
     * @since 1.0.0
     */
    public static function isValidValue($value, bool $strict = true): bool
    {
        $values = \array_values(static::getConstants());
        return \in_array($value, $values, $strict);
    }

    /**
     * Get the value for the name
     * (Value for the constant name)
     *
     * @param  string  $constName
     * @return mixed
     * @throws \Exception
     * @since 1.0.0
     */
    public static function getValue(string $constName)
    {
        $const = static::getConstants();
        if (\array_key_exists($constName, $const) === true)
        {
            return $const[$constName];
        }
        throw new EnumException(
            \sprintf(
                'Value "%s" doesn\'t exist', $constName
            )
        );
    }

    /**
     * Get the constant name for the value
     *
     * @param  string $value
     * @param  bool   $strict
     * @return string
     * @throws EnumException
     * @since 1.0.0
     */
    public static function getName(string $value, bool $strict = false): string
    {
        $constants = static::getConstants();
        foreach ($constants as $k => $v)
        {
            if ($strict && $value === $v)
            {
                return (string) $k;
            }
            if (!$strict && $value == $v)
            {
                return (string) $k;
            }
        }
        throw new EnumException("Value $value not exist in " . get_called_class());
    }

    /**
     *
     * Get the value seted in teh enumeration
     *
     * @return Scalar
     * @since 1.0.0
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * Verify if the value is equals
     * @param AEnum|scalar $value
     * @return bool
     * @since 1.1.0
     */
    public function isEqual($value): bool
    {
        if ($value instanceof AEnum)
        {
            return $value->get() === $this->get();
        }
        return $value === $this->get();
    }

    /**
     * Verifi if the value in not equal
     * @param AEnum|scalar $value
     * @return bool
     * @since 1.1.0
     */
    public function isNotEqual($value): bool
    {
        return !$this->isEqual($value);
    }

    /**
     *
     * @param String $name
     * @param array $arguments
     * @return object
     * @since 1.1.1
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new EnumException("No argument should be passed to instanciate the enum");
        }
        $obj = get_called_class();
        return new $obj($name);
    }

    /**
     *
     * @return string
     * @since 2.0.0
     */
    public function __toString()
    {
        return (string) $this->value;
    }
}
