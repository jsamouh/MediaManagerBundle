<?php

namespace Ylly\MediaManagerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Parameter;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MediaManagerExtension extends Extension
{
	
	public  function load(array $config, ContainerBuilder $configuration)
	{
		$this->loadDefaultConfiguration($configuration);

		if (isset($config[0]) && isset($config[0]['class']))
		{
            $configuration->setParameter('media_manager.entity.media', $config[0]['class']['model']['media']);
            $configuration->setParameter('media_manager.form.media',   $config[0]['class']['form']['media']);
		}
		
        $configuration->register('media_manager.manager', 'Ylly\MediaManagerBundle\Entity\MediaManager')
                      ->addArgument(new Parameter('media_manager.entity.media'))
                      ->addArgument(new Parameter('media_manager.form.media'));

		$configuration->register('media_manager.form', new Parameter('media_manager.form.media'));                      
	}
	
	/**
	 * Method to load the default configuration of MediaManagerBundle
	 * @param ContainerBuilder $configuration
	 */
	public function loadDefaultConfiguration(ContainerBuilder $configuration)
	{
        $configuration->setParameter('media_manager.entity.media', '\Ylly\MediaManagerBundle\Entity\Media');
        $configuration->setParameter('media_manager.form.media',   '\Ylly\MediaManagerBundle\Form\Admin\Media');
        		
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