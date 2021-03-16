<?php

namespace Questpass\SDK;

interface SubscriberStorage
{
    public function persist(Subscriber $subscriber);
    public function get();
    public function drop();
}
