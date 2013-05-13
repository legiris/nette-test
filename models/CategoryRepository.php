<?php

class CategoryRepository extends AbstractRepository
{
	
	public function fetch()
	{	
		$category = $this->em->getRepository('Category')->find(1);
		
		return $category;
	}
	
	
}