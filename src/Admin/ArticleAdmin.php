<?php

namespace App\Admin;

use App\Entity\Article;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Sodium\add;

final class ArticleAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $formMapper): void
	{
//		$formMapper->add('id', TextType::class);
		$formMapper->add('title', TextType::class)
			->add('slug', TextType::class)
			->add('content', TextType::class)
			->add('author', TextType::class)
			->add('heart_count', TextType::class)
			->add('image_filename', TextType::class);
//			->add('createdAt', TextType::class)
//			->add('updateAt', TextType::class);


	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
	{
		$datagridMapper->add('id')
			->add('title')
			->add('content')
			->add('slug')
			->add('publishedAt')
			->add('author');
//		$datagridMapper->add('heart_count');
//		$datagridMapper->add('image_filename');
//		$datagridMapper->add('createdAt');
//		$datagridMapper->add('updateAt');
	}

	protected function configureListFields(ListMapper $listMapper): void
	{
		$listMapper->addIdentifier('id')
		->addIdentifier('title')
		->addIdentifier('slug')
//		->addIdentifier('content')
		->addIdentifier('publishedAt')
		->addIdentifier('author')
		->addIdentifier('heart_count')
		->addIdentifier('image_filename')
		->addIdentifier('createdAt')
		->addIdentifier('updateAt');
	}

//	public function toString(object $object): string
//	{
//		return $object instanceof Article
//			? $object->getTitle()
//			: 'Blog Post'; // shown in the breadcrumb on the create view
//	}
}