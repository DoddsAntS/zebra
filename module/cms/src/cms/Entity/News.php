<?php
namespace cms\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * 
 * @ORM\Table(name="news")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @author Anthony Dodds (Zebra Web Design)
 * @package News
 */

class News extends Entity {
    
    private $id;
    
    private $title;
    
    private $body;
    
    private $addTime;
    
    private $modifiedTime;
    
    private $expireTime;
    
}