# Enum

Enum is a workaround to work with Enumeration on PHP

## Example
```
``` php
/**
 * The enumeration class
 */
final class MyExample extends \Rebelo\Enum\AEnum
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
     * This method will only acept values of MyExample enumeration class
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

```
## Install

Via Composer

```bash
$ composer require joaomfrebelo/enum
```


## License
Copyright (c) 2019 João M F Rebelo

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.