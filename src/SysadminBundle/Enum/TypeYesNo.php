<?php

namespace SysadminBundle\Enum;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Description of TypeYesNo
 *
 * @author Karen
 */
final class TypeYesNo extends AbstractEnumType {

    const TYPE_YES = 'Y';
    const TYPE_NO = 'N';

    protected static $choices = [
        self::TYPE_YES => 'SIM',
        self::TYPE_NO => 'NÃO'
    ];

}
