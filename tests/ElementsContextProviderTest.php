<?php

namespace Questpass\SDK\Tests;

use PHPUnit\Framework\TestCase;
use Questpass\SDK\ElementsContextProvider;

class ElementsContextProviderTest extends TestCase
{
    function testSetsRandomIds()
    {
        $instance = new ElementsContextProvider();
        $this->assertNotNull($instance->mainQuestId());
        $this->assertNotNull($instance->reminderQuestId());
    }
}
