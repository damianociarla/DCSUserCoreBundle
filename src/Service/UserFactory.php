<?php

namespace DCS\User\CoreBundle\Service;

class UserFactory implements UserFactoryInterface
{
    /**
     * @var string
     */
    private $className;

    public function __construct($className)
    {
        $this->className = $className;
    }

    /**
     * @inheritdoc
     */
    public function create()
    {
        return (new $this->className());
    }
}