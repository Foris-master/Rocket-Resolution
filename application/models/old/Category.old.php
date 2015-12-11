<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcategory", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategory;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Coach", mappedBy="categorycategory")
     */
    private $coachcoach;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->coachcoach = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idcategory
     *
     * @return integer 
     */
    public function getIdcategory()
    {
        return $this->idcategory;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Category
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
     * Set name
     *
     * @param string $name
     * @return Category
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
     * Add coachcoach
     *
     * @param \Coach $coachcoach
     * @return Category
     */
    public function addCoachcoach(\Coach $coachcoach)
    {
        $this->coachcoach[] = $coachcoach;
    
        return $this;
    }

    /**
     * Remove coachcoach
     *
     * @param \Coach $coachcoach
     */
    public function removeCoachcoach(\Coach $coachcoach)
    {
        $this->coachcoach->removeElement($coachcoach);
    }

    /**
     * Get coachcoach
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoachcoach()
    {
        return $this->coachcoach;
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
        return array('id'=>$this->getIdcategory(),
            'name'=> $this->getName(),
            'description'=>$this->getDescription()
        );
    }
}