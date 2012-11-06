<?php

namespace cms\Entity\Forum\Category\Topic;


use Doctrine\ORM\Mapping as ORM;
use cms\Entity\Entity;

/**
 * Description of Topic
 *
 * @author tallen
 */

class Reply extends Entity {
    
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
     * @var cms\Entity\Forum\Category\Topic
     * @ORM\ManyToOne(targetEntity="cms\Entity\Forum\Category\Topic",inversedBy="replies",cascade={"persist","remove"})
     */
    private $topic;
    
    /**
     *
     * @var cms\Entity\Forum\Category\Topic\Reply
     * @ORM\ManyToOne(targetEntity="cms\Entity\Forum\Category\Topic\Reply")
     */
    private $replyTo;
    
    
    
        public function prePersist() {
        if(!($this->addDate instanceof \DateTime)) {
            $this->addDate = new \DateTime();
        }
    }
    
}

?>
