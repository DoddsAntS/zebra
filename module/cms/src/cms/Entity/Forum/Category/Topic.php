<?php

namespace cms\Entity\Forum\Category;


use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;

/**
 * Description of Topic
 *
 * @author tallen
 * @ORM\Entity
 * @ORM\Table(name="forum_topics")
 * @package Topic
 */

class Topic extends Entity {

          /**
     *
     * @var integer
     * @ORM\Column(type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */  
    private $id;
    
      /**
     * @var string
     * @ORM\Column(type="string",length=50,nullable=false)
     */
    private $name;
    
     /**
     * @var text
     * @ORM\Column(type="text",nullable=false)
     */
    private $content;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $active;
    
       /**
     *
     * @var datetime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $addDate;
    
    
        /**
     *
     * @var cms\Entity\Forum
     * @ORM\ManyToOne(targetEntity="cms\Entity\Forum\Category",inversedBy="topics",cascade={"persist","remove"})
     */
    private $category;
    
            /**
     *
     * @var cms\Entity\Forum\Category\Topic\Reply
     * @ORM\OneToMany(targetEntity="cms\Entity\Forum\Category\Topic\Reply",mappedBy="topic",cascade={"persist","remove"})
     */
    private $replies;
    
    
     public function prePersist() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
    }    
    
    public function __get($property) {
        return $this->{$property};
    }
    
    public function __set($property, $value) {
        $this->{$property} = $value;
    }
    
}
?>
