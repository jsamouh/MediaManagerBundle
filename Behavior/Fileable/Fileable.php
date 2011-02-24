<?php

namespace yProx\MediaManagerBundle\Behavior\Fileable;

/**
 * This interface is not necessary but can be implemented for
 * Entities which in some cases needs to be identified as
 * Fileable
 * 
 * @author Jordan Samouh <lifeextension25@gmail.com>
 * @version: 1.0
 */
interface Fileable
{
    // fileable expects annotations on properties
    
    /**
     * @yprox:Fileable
     * to mark your object Fileable
     */
    
}