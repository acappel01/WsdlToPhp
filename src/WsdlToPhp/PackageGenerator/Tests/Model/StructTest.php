<?php
namespace WsdlToPhp\PackageGenerator\Tests;

use WsdlToPhp\PackageGenerator\Model\StructValue;
use WsdlToPhp\PackageGenerator\Model\Struct;

class StructTest extends TestCase
{
    /**
     * @param string $name
     * @param bool $isStruct
     * @return Struct
     */
    public static function instance($name, $isStruct)
    {
        return new Struct($name, $isStruct);
    }
    /**
     *
     */
    public function testGetContextualPartEnum()
    {
        $struct = self::instance('Foo', false);
        $struct->setIsRestriction(true);
        $this->assertEquals(Struct::CONTEXTUAL_PART_ENUMERATION, $struct->getContextualPart());
        $struct->setIsStruct(false);
        $this->assertEquals(Struct::CONTEXTUAL_PART_ENUMERATION, $struct->getContextualPart());
        $struct->setIsStruct(true);
        $this->assertEquals(Struct::CONTEXTUAL_PART_ENUMERATION, $struct->getContextualPart());
    }
    /**
     *
     */
    public function testGetDocSubPackagesEnum()
    {
        $struct = self::instance('Foo', false);
        $struct->setIsRestriction(true);
        $this->assertContains(Struct::DOC_SUB_PACKAGE_ENUMERATIONS, $struct->getDocSubPackages());
        $struct->setIsStruct(false);
        $this->assertContains(Struct::DOC_SUB_PACKAGE_ENUMERATIONS, $struct->getDocSubPackages());
        $struct->setIsStruct(true);
        $this->assertContains(Struct::DOC_SUB_PACKAGE_ENUMERATIONS, $struct->getDocSubPackages());
    }
    /**
     *
     */
    public function testGetContextualPartStruct()
    {
        $struct = self::instance('Foo', false);
        $this->assertEquals(Struct::CONTEXTUAL_PART_STRUCT, $struct->getContextualPart());
        $struct->setIsRestriction(false);
        $this->assertEquals(Struct::CONTEXTUAL_PART_STRUCT, $struct->getContextualPart());
        $struct->setIsStruct(true);
        $this->assertEquals(Struct::CONTEXTUAL_PART_STRUCT, $struct->getContextualPart());
    }
    /**
     *
     */
    public function testGetDocSubPackagesStruct()
    {
        $struct = self::instance('Foo', false);
        $this->assertContains(Struct::DOC_SUB_PACKAGE_STRUCTS, $struct->getDocSubPackages());
        $struct->setIsRestriction(false);
        $this->assertContains(Struct::DOC_SUB_PACKAGE_STRUCTS, $struct->getDocSubPackages());
    }
    /**
     *
     */
    public function testIsArray()
    {
        $struct = self::instance('ArrayFoo', false);
        $struct->addAttribute('ArrayOfId', 'array');
        $this->assertTrue($struct->isArray());

        $struct->setName('Foo');
        $this->assertFalse($struct->isArray());

        $struct->setName('ArrayFoo');
        $struct->addAttribute('ArrayOfString', 'array');
        $this->assertFalse($struct->isArray());
    }
    /**
     *
     */
    public function testGetValue()
    {
        $struct = self::instance('Foo', true);
        $struct->addValue('id');
        $struct->addValue('name');
        $struct->addValue('_key');
        $this->assertInstanceOf('\\WsdlToPhp\\PackageGenerator\\Model\\StructValue', $struct->getValue('id'));
        $this->assertNotInstanceOf('\\WsdlToPhp\\PackageGenerator\\Model\\StructValue', $struct->getValue('_id'));
    }
    /**
     *
     */
    public function testGetAttibute()
    {
        $struct = self::instance('Foo', true);
        $struct->addAttribute('id', 'int');
        $struct->addAttribute('name', 'string');
        $struct->addAttribute('_key', 'string');
        $this->assertInstanceOf('\\WsdlToPhp\\PackageGenerator\\Model\\StructAttribute', $struct->getAttribute('id'));
        $this->assertNotInstanceOf('\\WsdlToPhp\\PackageGenerator\\Model\\StructAttribute', $struct->getAttribute('_id'));
    }
}
