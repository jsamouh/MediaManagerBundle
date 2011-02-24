<?php

namespace yProx\MediaManagerBundle\Behavior\Fileable;

use Doctrine\Common\EventSubscriber,
    Doctrine\ORM\Events,
    Doctrine\ORM\Event\LifecycleEventArgs,
    Doctrine\ORM\Event\OnFlushEventArgs,
    Gedmo\Mapping\MappedEventSubscriber,
    Doctrine\ORM\EntityManager;

/**
 * The Timestampable listener handles the update of
 * dates on creation and update of entity.
 * 
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 * @package Gedmo.Timestampable
 * @subpackage TimestampableListener
 * @link http://www.gediminasm.org
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class FileableListener extends MappedEventSubscriber implements EventSubscriber
{
	
	protected $_files = array(1);
    /**
     * Specifies the list of events to listen
     * 
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::onFlush
        );
    }
    
	/**
     * {@inheritDoc}
     */
    protected function _getNamespace()
    {
        return __NAMESPACE__;
    }
    
    public function getFiles()
    {
    	return $this->_files;
    }
    
    public function setFiles($medias)
    {
    	
    }
    
    public function addFile($media)
    {
    	
    }
    
    /**
     * Looks for Timestampable entities being updated
     * to update modification date
     * 
     * @param OnFlushEventArgs $args
     * @return void
     */
    public function onFlush(OnFlushEventArgs $args)
    {
    	// put flush operation here
    }
    
}