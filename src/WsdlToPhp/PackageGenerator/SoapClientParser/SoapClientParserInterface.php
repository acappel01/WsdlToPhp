<?php

namespace WsdlToPhp\PackageGenerator\SoapClientParser;

use WsdlToPhp\PackageGenerator\Generator\Generator;

interface SoapClientParserInterface
{
    /**
     * @param Generator $generator
     * @return SoapClientParserInterface
     */
    public function __construct(Generator $generator);
    /**
     * This method is called to launch the data parsing
     * If an exception must be throwned, then it must throwned here
     * @return void
     */
    public function parse();
}
