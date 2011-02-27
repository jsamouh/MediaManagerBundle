<?php
namespace Ylly\MediaManagerBundle\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
/**
* LongBLOB type user for the project
*
* @author Jordan Samouh <lifeextension25@gmail.com>
*/
class LongBlob extends Type
{
const LONG_BLOB = 'longblob';

    public function getName()
    {
        return self::LONG_BLOB;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getDoctrineTypeMapping('LONGBLOB');
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return ($value === null) ? null : base64_encode($value);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return ($value === null) ? null : base64_decode($value);
    }
}