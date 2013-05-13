<?php

use Doctrine\ORM\EntityManager;

class AbstractRepository extends Nette\Object
{
	protected $em;
	
	public function __construct(Doctrine\ORM\EntityManager $em)
	{
		$this->em = $em;
	}
	
}