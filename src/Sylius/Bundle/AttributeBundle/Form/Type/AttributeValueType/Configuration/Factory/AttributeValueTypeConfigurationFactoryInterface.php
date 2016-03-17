<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AttributeBundle\Form\Type\AttributeValueType\Configuration\Factory;

use Sylius\Bundle\AttributeBundle\Form\Type\AttributeValueType\Configuration\AttributeValueTypeConfigurationInterface;
use Sylius\Component\Attribute\Model\AttributeInterface;

/**
 * @author Salvatore Pappalardo <salvatore.pappalardo82@gmail.com>
 */
interface AttributeValueTypeConfigurationFactoryInterface
{
    /**
     * @param AttributeInterface $attribute
     * @param $subjectName
     * @param null $counter
     * @return AttributeValueTypeConfigurationInterface
     */
    public function create(AttributeInterface $attribute, $subjectName, $counter = null);
}
