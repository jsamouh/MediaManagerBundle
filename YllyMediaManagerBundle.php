<?php

namespace Ylly\MediaManagerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Doctrine\DBAL\Types\Type;

class YllyMediaManagerBundle extends Bundle
{
	public function boot()
	{
		$em = $this->container->get('doctrine.orm.default_entity_manager');
		Type::addType('longblob', 'Ylly\MediaManagerBundle\Types\LongBlob');
		$em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('LONGBLOB', 'longblob');
		
		
		/*$classLoader = new \Doctrine\Common\ClassLoader('Ylly', __DIR__."/Behavior");
        $classLoader->register();
        
        $evm = $em->getEventManager();
        
        
        $fileableListener = new \Ylly\MediaManagerBundle\Behavior\Fileable\FileableListener();
        $evm->addEventSubscriber($fileableListener);*/
        
	}
}
