<?php

namespace Rebelo\Test\Enum;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2019-01-26 at 22:01:21.
 */
class AEnumTest
    extends \PHPUnit\Framework\TestCase
{

    /**
     * @var AEnum
     */
    protected $object;

    /**
     * Initialization of AEnum in an anonymous class
     */
    protected function setUp()
    {
        $this->object = new MyEnum(MyEnum::ENUM_1);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers \Rebelo\Enum\AEnum::isValidName
     */
    public function testIsValidNameTrue()
    {
        $this->assertTrue($this->object->isValidName("ENUM_1"));
    }

    /**
     * @covers \Rebelo\Enum\AEnum::isValidName
     */
    public function testIsValidNameFalse()
    {
        $this->assertFalse($this->object->isValidName("ENUM_A"));
    }

    /**
     * @covers \Rebelo\Enum\AEnum::isValidValue
     */
    public function testIsValidValueTrue()
    {
        $this->assertTrue($this->object->isValidValue(MyEnum::ENUM_1));
    }

    /**
     * @covers \Rebelo\Enum\AEnum::isValidValue
     */
    public function testIsValidValueFalse()
    {
        $this->assertFalse($this->object->isValidValue("ENUM_A"));
    }

    /**
     * @covers \Rebelo\Enum\AEnum::getValue
     */
    public function testGetValueOfConstant()
    {
        $this->assertEquals(MyEnum::ENUM_1, $this->object->getValue("ENUM_1"));
    }

    /**
     * @covers \Rebelo\Enum\AEnum::getName
     */
    public function testGetName()
    {
        $this->assertEquals("ENUM_1", $this->object->getName(MyEnum::ENUM_1));
    }

    /**
     *
     */
    public function testWrongInit()
    {
        $this->expectException(\Rebelo\Enum\EnumException::class);
        new MyEnum("wrong_value");
    }

    /**
     * @covers \Rebelo\Enum\AEnum::get()
     */
    public function testGetValue()
    {
        $myEnum = new MyEnum(MyEnum::ENUM_2);
        $this->assertEquals(MyEnum::ENUM_2, $myEnum->get());
    }

    public function testIsEqualAndNotEqual()
    {
        $myEnum  = new MyEnum(MyEnum::ENUM_2);
        $myClone = clone $myEnum;
        $this->assertTrue($myEnum->isEqual($myClone));
        $this->assertFalse($myEnum->isNotEqual($myClone));
        $this->assertTrue($myEnum->isEqual(MyEnum::ENUM_2));
        $this->assertFalse($myEnum->isNotEqual(MyEnum::ENUM_2));
    }

}
