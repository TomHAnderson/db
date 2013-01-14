<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;

class Wanted extends AbstractEntity
{
    use \Db\Field\Id;
    use \Db\Field\User;
    use \Db\Field\Show;
    use \Db\Field\Source;
}
