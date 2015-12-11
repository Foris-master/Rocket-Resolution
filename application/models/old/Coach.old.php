<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Coach
 *
 * @ORM\Table(name="coach")
 * @ORM\Entity
 */
class Coach implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcoach", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcoach;

    /**
     * @var string
     *
     * @ORM\Column(name="grade", type="string", length=45, nullable=true)
     */
    private $grade;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="coachcoach")
     * @ORM\JoinTable(name="coach_has_category",
     *   joinColumns={
     *     @ORM\JoinColumn(name="coach_idcoach", referencedColumnName="idcoach")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="category_idcategory", referencedColumnName="idcategory")
     *   }
     * )
     */
    private $categorycategory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Resolution", inversedBy="coachcoach")
     * @ORM\JoinTable(name="coach_has_resolution",
     *   joinColumns={
     *     @ORM\JoinColumn(name="coach_idcoach", referencedColumnName="idcoach")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="resolution_idresolution", referencedColumnName="idresolution")
     *   }
     * )
     */
    private $resolutionresolution;

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
     * Constructor
     */
    public function __construct()
    {
        $this->categorycategory = new \Doctrine\Common\Collections\ArrayCollection();
        $this->resolutionresolution = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idcoach
     *
     * @return integer 
     */
    public function getIdcoach()
    {
        return $this->idcoach;
    }

    /**
     * Set grade
     *
     * @param string $grade
     * @return Coach
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    
        return $this;
    }

    /**
     * Get grade
     *
     * @return string 
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Coach
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Add categorycategory
     *
     * @param \Category $categorycategory
     * @return Coach
     */
    public function addCategorycategory(\Category $categorycategory)
    {
        $this->categorycategory[] = $categorycategory;
    
        return $this;
    }

    /**
     * Remove categorycategory
     *
     * @param \Category $categorycategory
     */
    public function removeCategorycategory(\Category $categorycategory)
    {
        $this->categorycategory->removeElement($categorycategory);
    }

    /**
     * Get categorycategory
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategorycategory()
    {
        return $this->categorycategory;
    }

    /**
     * Add resolutionresolution
     *
     * @param \Resolution $resolutionresolution
     * @return Coach
     */
    public function addResolutionresolution(\Resolution $resolutionresolution)
    {
        $this->resolutionresolution[] = $resolutionresolution;
    
        return $this;
    }

    /**
     * Remove resolutionresolution
     *
     * @param \Resolution $resolutionresolution
     */
    public function removeResolutionresolution(\Resolution $resolutionresolution)
    {
        $this->resolutionresolution->removeElement($resolutionresolution);
    }

    /**
     * Get resolutionresolution
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResolutionresolution()
    {
        return $this->resolutionresolution;
    }

    /**
     * Set useruser
     *
     * @param \User $useruser
     * @return Coach
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

    function jsonSerialize()
    {
        return array('id'=>$this->getIdcoach(),
            'grade'=> $this->getGrade(),
            'start_date'=>$this->getStartDate(),
            'user'=>$this->getUseruser()
        );
    }
}