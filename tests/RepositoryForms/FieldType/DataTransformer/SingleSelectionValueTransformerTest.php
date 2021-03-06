<?php

/**
 * This file is part of the eZ RepositoryForms package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */
namespace EzSystems\RepositoryForms\Tests\FieldType\DataTransformer;

use eZ\Publish\Core\FieldType\Selection\Value;
use EzSystems\RepositoryForms\FieldType\DataTransformer\SingleSelectionValueTransformer;
use PHPUnit\Framework\TestCase;

class SingleSelectionValueTransformerTest extends TestCase
{
    public function transformProvider()
    {
        return [
            [0],
            [1],
            [42],
        ];
    }

    /**
     * @dataProvider transformProvider
     */
    public function testTransform($value)
    {
        $transformer = new SingleSelectionValueTransformer();
        $valueAsArray = [$value];
        self::assertSame($valueAsArray, $transformer->transform(new Value($valueAsArray)));
    }

    /**
     * @dataProvider transformProvider
     */
    public function testReverseTransform($value)
    {
        $transformer = new SingleSelectionValueTransformer();
        $expectedValue = new Value([$value]);
        self::assertEquals($expectedValue, $transformer->reverseTransform($value));
    }

    public function transformNullProvider()
    {
        return [
            [new \eZ\Publish\Core\FieldType\Selection\Value()],
            [[]],
            [false],
            [''],
        ];
    }

    /**
     * @dataProvider transformNullProvider
     */
    public function testTransformNull($value)
    {
        $transformer = new SingleSelectionValueTransformer();
        self::assertNull($transformer->transform($value));
    }

    public function testReverseTransformNull()
    {
        $transformer = new SingleSelectionValueTransformer();
        self::assertNull($transformer->reverseTransform(null));
    }
}
