<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Atout
 *
 * @ORM\Table(name="atout")
 * @ORM\Entity
 */
class Atout implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idatout", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idatout;

    /**
     * @var string
     *
     * @ORM\Column(name="atout", type="string", length=255, nullable=false)
     */
    private $atout;

    /**
     * @var \CoachDemand
     *
     * @ORM\ManyToOne(targetEntity="CoachDemand")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="coach_demand_idcoach_demand", referencedColumnName="idcoach_demand")
     * })
     */
    private $coachDemandcoachDemand;


    /**
     * Get idatout
     *
     * @return integer 
     */
    public function getIdatout()
    {
        return $this->idatout;
    }

    /**
     * Set atout
     *
     * @param string $atout
     * @return Atout
     */
    public function setAtout($atout)
    {
        $this->atout = $atout;
    
        return $this;
    }

    /**
     * Get atout
     *
     * @return string 
     */
    public function getAtout()
    {
        return $this->atout;
    }

    /**
     * Set coachDemandcoachDemand
     *
     * @param \CoachDemand $coachDemandcoachDemand
     * @return Atout
     */
    public function setCoachDemandcoachDemand(\CoachDemand $coachDemandcoachDemand = null)
    {
        $this->coachDemandcoachDemand = $coachDemandcoachDemand;
    
        return $this;
    }

    /**
     * Get coachDemandcoachDemand
     *
     * @return \CoachDemand 
     */
    public function getCoachDemandcoachDemand()
    {
        return $this->coachDemandcoachDemand;
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
        return array('id'=>$this->getIdatout(),
            'atout'=> $this->getAtout(),
            'coach_demand'=>$this->getCoachDemandcoachDemand()

        );
    }
}
