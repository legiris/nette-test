<?php

namespace AdminModule;

use Nette\Application\UI\Form;

class PridatKategoriiPresenter extends BasePresenter
{	
	protected function createComponentCategoryForm()
	{
		$form = new Form();

		$form->addText('name', 'Zadejte název kategorie:', 30, 100);
		$form->addSubmit('submit', 'Přidat');
		
		$form->onSuccess[] = callback($this, 'categoryFormSubmit');
		
		return $form;
	}
	
	
	public function categoryFormSubmit(Form $form)
	{	
		//$category = $this->context->categoryRepository->getCategoryName(1);
	}

	
	public function renderDefault()
	{
		$this->template->categoryName = 'default';		
		$this->template->categoryName = $this->context->categoryRepository->fetch();
		//$this->template->categoryName = $this->context->entityManager->getRepository('Category')->fetch();
	}
	
}