<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * CoachDemand
 *
 * @ORM\Table(name="coach_demand")
 * @ORM\Entity
 */
class CoachDemand implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcoach_demand", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcoachDemand;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     */
    private $createDate;

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_idcategory", referencedColumnName="idcategory")
     * })
     */
    private $categorycategory;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_iduser", referencedColumnName="iduser")
     * })
     */
    private $useruser;


    /**
     * Get idcoachDemand
     *
     * @return integer 
     */
    public function getIdcoachDemand()
    {
        return $this->idcoachDemand;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return CoachDemand
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return CoachDemand
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    
        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set categorycategory
     *
     * @param \Category $categorycategory
     * @return CoachDemand
     */
    public function setCategorycategory(\Category $categorycategory = null)
    {
        $this->categorycategory = $categorycategory;
    
        return $this;
    }

    /**
     * Get categorycategory
     *
     * @return \Category 
     */
    public function getCategorycategory()
    {
        return $this->categorycategory;
    }

    /**
     * Set useruser
     *
     * @param \User $useruser
     * @return CoachDemand
     */
    public function setUseruser(\User $useruser = null)
    {
        $this->useruser = $useruser;
    
        return $this;
    }

    /**
     * Get useruser
     *
     * @return \User 
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
        return array('id'=>$this->getIdcoachDemand(),
            'category'=> $this->getCategorycategory()->getIdcategory(),
            'status'=>$this->getStatus(),
            'create_date'=>$this->getCreateDate(),
            'user'=>$this->getUseruser()->getIduser()
        );
    }
}
