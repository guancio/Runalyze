<?php
/**
 * This file contains class::ModelQuery
 * @package Runalyze\Calculation\Performance
 */

namespace Runalyze\Calculation\Performance;

/**
 * Query for performance model
 *
 * @author Hannes Christiansen
 * @package Runalyze\Calculation\TrainingLoad
 */
class ModelQuery {
    
        private $em;
        
	/**
	 * Accountid
	 * @var int
	 */
	protected $accountid = null;

        
	/**
	 * Timestamp: from
	 * @var int
	 */
	protected $From = null;

	/**
	 * Timestamp: to
	 * @var int
	 */
	protected $To = null;

	/**
	 * Sportid
	 * @var int
	 */
	protected $Sportid = null;

	/**
	 * Result data
	 * @var array
	 */
	protected $Data = array();

	/**
	 * Construct
         * @paramt $em EntityManager
	 * @param int $from [optional] timestamp
	 * @param int $to [optional] timestamp
	 */
	public function __construct($em, $account, $from = null, $to = null) {
		//$this->setRange($from, $to);
                if($account) {
                    $this->accountid = $account->getId();
                }
                $this->em = $em->getRepository('RunalyzeCoreBundle:Training');
	}
        
        public function setAccountid($accountid) {
            $this->accountid = $accountid;
        }
	/**
	 * Set time range
	 * @param int $from
	 * @param int $to
	 */
	public function setRange($from, $to) {
		$this->From = $this->setHour($from,"0:00");
		$this->To = $this->setHour($to,"23:59");
	}

	/**
	 * set hour of timestamp
	 */
	public function setHour($timestamp, $hour="0:00") {
		if ($timestamp==null) return null;
		return strtotime($hour, $timestamp);
	}

	/**
	 * Set sportid
	 * @param int $id
	 */
	public function setSportid($id) {
		$this->Sportid = $id;
	}

	/**
	 * Get data
	 * @return array
	 */
	public function data() {
		return $this->Data;
	}

	/**
	 * Execute
	 * @param \PDOforRunalyze $DB
	 */
	public function execute() {
		$this->Data = array();
		$Today = new \DateTime('today 23:59');

		$Statement = $this->query();
                foreach($Statement as $state) {
			$index = (int)$Today->diff(new \DateTime('@'.$state['time']))->format('%r%a');
			$this->Data[$index] = $state['trimp'];                 
                }
                    
		/*while ($row = $Statement->fetch()) {*/
			// Don't rely on MySQLs timezone => calculate diff based on timestamp
			//$index = (int)$Today->diff(new \DateTime('@'.$row['time']))->format('%r%a');
			//$this->Data[$index] = $row['trimp'];
		/*}*/
                //return $Statement;
	}

	/**
	 * Get query
	 *
	 * @return string
	 */
	private function query() {
            echo "test";
            $qb = $this->em->createQueryBuilder('t');
            $qb->select('t.time, DATE(FROM_UNIXTIME(t.time)) as date, SUM(t.trimp) as trimp');
            //$qb->from('RunalyzeCoreBundle:Training', 't');
            $parameters['accountid'] = $this->accountid;
            $qb->Where('t.accountid = :accountid');
		if (!is_null($this->From) && !is_null($this->To)) {
                    $parameters['from'] = $this->From;
                    $parameters['to'] = $this->To;
                        $qb->andWhere('t.time BETWEEN :from AND :to');
		}

		if (!is_null($this->Sportid)) {
                    $parameters['sportid'] = $this->Sportid;
                       $qb->andWhere('t.sportid = :sportid');
		}
                $qb->groupBy('date');
		/*	`time`,
				DATE(FROM_UNIXTIME(`time`)) as `date`,
				SUM(`trimp`) as `trimp`*/

                $qb->setParameters($parameters);
                $result = $qb->getQuery()->getArrayResult();
		return $result;
	}
}