<?php

/**
 * The enumeration class
 */
final class MyExample
    extends \Rebelo\Enum\AEnum
{

    const EXAMPLE_1 = 1;
    const EXAMPLE_2 = 2;

    public function __construct($value)
    {
        parent::__construct($value);
    }

}

class Foo
{

    /**
     *
     * This methos will only acept values of MyExample enumeration class
     *
     * @param MyExample $myExample
     */
    public function myMethod(MyExample $myExample)
    {
        $value = $myExample->get();
        // do stuff
    }

}

$foo = new foo();
$foo->myMethod(new MyExample(MyExample::EXAMPLE_1));
