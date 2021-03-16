<?php

namespace Questpass\SDK;

interface JavascriptStorage
{
    public function get();

    public function set($contents);

    public function valid();
}
