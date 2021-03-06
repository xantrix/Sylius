<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Behat\Page\Channel;

use Sylius\Behat\Page\SymfonyPage;

/**
 * @author Kamil Kokot <kamil.kokot@lakion.com>
 */
class ChannelUpdatePage extends SymfonyPage implements ChannelUpdatePageInterface
{
    /**
     * {@inheritdoc}
     */
    public function setTheme($themeName)
    {
        $this->getDocument()->selectFieldOption('Theme', $themeName);
    }

    /**
     * {@inheritdoc}
     */
    public function unsetTheme()
    {
        $this->getDocument()->selectFieldOption('Theme', '');
    }

    /**
     * {@inheritdoc}
     */
    public function update()
    {
        $this->getDocument()->pressButton('Save changes');
    }

    protected function getRouteName()
    {
        return 'sylius_backend_channel_update';
    }
}
