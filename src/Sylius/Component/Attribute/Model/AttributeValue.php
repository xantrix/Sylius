<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Component\Attribute\Model;

use Sylius\Component\Translation\Model\TranslatableTrait;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class AttributeValue implements AttributeValueInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var AttributeSubjectInterface
     */
    protected $subject;

    /**
     * @var AttributeInterface
     */
    protected $attribute;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var bool
     */
    protected $boolean;

    /**
     * @var int
     */
    protected $integer;

    /**
     * @var float
     */
    protected $float;

    /**
     * @var \DateTime
     */
    protected $datetime;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * AttributeValue constructor.
     */
    public function __construct()
    {
        $this->initializeTranslationsCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * {@inheritdoc}
     */
    public function setSubject(AttributeSubjectInterface $subject = null)
    {
        $this->subject = $subject;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttribute(AttributeInterface $attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        if (null === $this->attribute) {
            return null;
        }

        $getter = 'get'.ucfirst($this->attribute->getStorageType());

        return $this->$getter();
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->assertAttributeIsSet();

        $property = $this->attribute->getStorageType();
        $this->$property = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        $this->assertAttributeIsSet();

        return $this->attribute->getCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        $this->assertAttributeIsSet();

        return $this->attribute->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        $this->assertAttributeIsSet();

        return $this->attribute->getType();
    }

    /**
     * @return bool
     */
    public function getBoolean()
    {
        return $this->boolean;
    }

    /**
     * @param bool $boolean
     */
    public function setBoolean($boolean)
    {
        $this->boolean = $boolean;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->translate()->getValue();
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->translate()->setValue($text);
    }

    /**
     * @return int
     */
    public function getInteger()
    {
        return $this->integer;
    }

    /**
     * @param int $integer
     */
    public function setInteger($integer)
    {
        $this->integer = $integer;
    }

    /**
     * @return float
     */
    public function getFloat()
    {
        return $this->float;
    }

    /**
     * @param float $float
     */
    public function setFloat($float)
    {
        $this->float = $float;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param \DateTime $datetime
     */
    public function setDatetime(\DateTime $datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }
    /**
     * @throws \BadMethodCallException
     */
    protected function assertAttributeIsSet()
    {
        if (null === $this->attribute) {
            throw new \BadMethodCallException('The attribute is undefined, so you cannot access proxy methods.');
        }
    }
}
