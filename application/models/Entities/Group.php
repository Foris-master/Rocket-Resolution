<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 *
 * @ORM\Table(name="group")
 * @ORM\Entity
 */
class Group implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idgroup", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgroup;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=5, nullable=false)
     */
    private $tag;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="groupgroup")
     */
    private $useruser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->useruser = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idgroup
     *
     * @return integer 
     */
    public function getIdgroup()
    {
        return $this->idgroup;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Group
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Group
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tag
     *
     * @param string $tag
     * @return Group
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    
        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Add useruser
     *
     * @param \User $useruser
     * @return Group
     */
    public function addUseruser(\User $useruser)
    {
        $this->useruser[] = $useruser;
    
        return $this;
    }

    /**
     * Remove useruser
     *
     * @param \User $useruser
     */
    public function removeUseruser(\User $useruser)
    {
        $this->useruser->removeElement($useruser);
    }

    /**
     * Get useruser
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUseruser()
    {
        return $this->useruser;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return array('id'=>$this->getIdgroup(),
            'description'=> $this->getDescription(),
            'name'=>$this->getName(),
            'tag'=>$this->getTag()
        );
    }
}
