<?php

namespace Rebelo\Test\Enum;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2019-01-26 at 22:01:21.
 */
class AEnumTest
    extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \Rebelo\Enum\AEnum
     */
    protected \Rebelo\Enum\AEnum $object;

    /**
     * Initialization of AEnum in an anonymous class
     * @return void
     */
    protected function setUp(): void
    {
        $this->object = new MyEnum(MyEnum::ENUM_1);
    }

    /**
     * @covers \Rebelo\Enum\AEnum::isValidName
     */
    public function testIsValidNameTrue(): void
    {
        $this->assertTrue($this->object->isValidName("ENUM_1"));
    }

    /**
     * @covers \Rebelo\Enum\AEnum::isValidName
     */
    public function testIsValidNameFalse(): void
    {
        $this->assertFalse($this->object->isValidName("ENUM_A"));
    }

    /**
     * @covers \Rebelo\Enum\AEnum::isValidValue
     */
    public function testIsValidValueTrue(): void
    {
        $this->assertTrue($this->object->isValidValue(MyEnum::ENUM_1));
    }

    /**
     * @covers \Rebelo\Enum\AEnum::isValidValue
     */
    public function testIsValidValueFalse(): void
    {
        $this->assertFalse($this->object->isValidValue("ENUM_A"));
    }

    /**
     * @covers \Rebelo\Enum\AEnum::getValue
     */
    public function testGetValueOfConstant(): void
    {
        $this->assertEquals(MyEnum::ENUM_1, $this->object->getValue("ENUM_1"));
    }

    /**
     * @covers \Rebelo\Enum\AEnum::getName
     */
    public function testGetName(): void
    {
        $this->assertEquals("ENUM_1", $this->object->getName(MyEnum::ENUM_1));
    }

    /**
     *
     */
    public function testWrongInit(): void
    {
        $this->expectException(\Rebelo\Enum\EnumException::class);
        new MyEnum("wrong_value");
    }

    /**
     * @covers \Rebelo\Enum\AEnum::get()
     */
    public function testGetValue(): void
    {
        $myEnum = new MyEnum(MyEnum::ENUM_2);
        $this->assertEquals(MyEnum::ENUM_2, $myEnum->get());
    }

    public function testIsEqualAndNotEqual(): void
    {
        $myEnum  = new MyEnum(MyEnum::ENUM_2);
        $myClone = clone $myEnum;
        $this->assertTrue($myEnum->isEqual($myClone));
        $this->assertFalse($myEnum->isNotEqual($myClone));
        $this->assertTrue($myEnum->isEqual(MyEnum::ENUM_2));
        $this->assertFalse($myEnum->isNotEqual(MyEnum::ENUM_2));
    }

    public function testCallStatic(): void
    {
        $enum = MyEnum::ENUM_1();
        $this->assertInstanceOf(
            MyEnum::class, $enum
        );
        $this->assertSame(MyEnum::ENUM_1, $enum->get());
    }

    public function testCallStaticArg(): void
    {
        $this->expectException(\Rebelo\Enum\EnumException::class);
        MyEnum::ENUM_1("a");
    }

    public function testMagigMethodToString(): void
    {
        $enum = MyEnum::ENUM_1();
        $this->assertSame(MyEnum::ENUM_1, $enum->__toString());
    }
    
    public function testEqualValueOfDirefentEnumClass() : void
    {
        $xEnum = new class extends \Rebelo\Enum\AEnum{
            const A = "A";
            
            public function __construct()
            {
                $this->value = self::A;
            }
        };
        
        $yEnum = new class extends \Rebelo\Enum\AEnum{
            const A = "A";
            
            public function __construct()
            {
                $this->value = self::A;
            }
        };
        
        $this->assertTrue($xEnum->isEqual($yEnum));
    }
}
