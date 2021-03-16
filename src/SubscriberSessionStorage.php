<?php

namespace Questpass\SDK;

class SubscriberSessionStorage implements SubscriberStorage
{
    const SESSION_KEY = 'questpass_subscriber';

    public function persist(Subscriber $subscriber)
    {
        $_SESSION[static::SESSION_KEY] = serialize($subscriber);
    }

    public function get()
    {
        if (!empty($_SESSION[static::SESSION_KEY])) {
            return unserialize($_SESSION[static::SESSION_KEY]);
        }
    }

    public function drop()
    {
        unset($_SESSION[static::SESSION_KEY]);
    }
}
