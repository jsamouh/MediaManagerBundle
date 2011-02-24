<?php

namespace yProx\MediaManagerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MediaManagerExtension extends Extension
{
	
	public  function load(array $config, ContainerBuilder $configuration)
	{
		
	}
	
    /**
     * @see Symfony\Component\DependencyInjection\Extension.ExtensionInterface::getXsdValidationBasePath()
     *
     * @codeCoverageIgnore
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension.ExtensionInterface::getNamespace()
     *
     * @codeCoverageIgnore
     */
    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/media_manager';
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension.ExtensionInterface::getAlias()
     *
     * @codeCoverageIgnore
     */
    public function getAlias()
    {
        return 'media_manager';
    }	
}