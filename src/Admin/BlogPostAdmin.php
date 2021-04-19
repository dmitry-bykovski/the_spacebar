<?php


namespace App\Admin;

use App\Entity\BlogPost;
use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BlogPostAdmin extends AbstractAdmin
{
	public function toString($object): string
	{
		return $object instanceof BlogPost
			? $object->getTitle()
			: 'Blog Post'; // shown in the breadcrumb on the create view
	}

	protected function configureFormFields(FormMapper $formMapper): void
	{
		$formMapper
			->tab('Post')
				->with('Content', ['class' => 'col-md-9'])
				->add('title', TextType::class)
				->add('body', TextareaType::class)
				->end()
			->end()
			->tab('Publish Options')
				->with('Meta data', ['class' => 'col-md-3'])
				->add('category', ModelType::class, [
					'class' => Category::class,
					'property' => 'name',
				])
				->end()
			->end()
		;
	}

	protected function configureListFields(ListMapper $listMapper): void
	{
		$listMapper
			->addIdentifier('title')
			->addIdentifier('category.name')
			->add('draft');

	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
	{
		$datagridMapper
			->add('title')
			->add('category', null, [
				'field_type' => EntityType::class,
				'field_options' => [
					'class' => Category::class,
					'choice_label' => 'name',
				],
			])
		;
	}
}