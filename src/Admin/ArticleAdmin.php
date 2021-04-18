<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ArticleAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $formMapper): void
	{
//		$formMapper->add('id', TextType::class);
		$formMapper->add('title', TextType::class);
		$formMapper->add('slug', TextType::class);
		$formMapper->add('content', TextType::class);
//		$formMapper->add('publishedAt', TextType::class);
		$formMapper->add('author', TextType::class);
		$formMapper->add('heart_count', TextType::class);
		$formMapper->add('image_filename', TextType::class);
//		$formMapper->add('createdAt', TextType::class);
//		$formMapper->add('updateAt', TextType::class);
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
	{
		$datagridMapper->add('id');
		$datagridMapper->add('title');
		$datagridMapper->add('content');
		$datagridMapper->add('slug');
		$datagridMapper->add('publishedAt');
		$datagridMapper->add('author');
//		$datagridMapper->add('heart_count');
//		$datagridMapper->add('image_filename');
//		$datagridMapper->add('createdAt');
//		$datagridMapper->add('updateAt');
	}

	protected function configureListFields(ListMapper $listMapper): void
	{
		$listMapper->addIdentifier('id');
		$listMapper->addIdentifier('title');
		$listMapper->addIdentifier('slug');
		$listMapper->addIdentifier('content');
		$listMapper->addIdentifier('publishedAt');
		$listMapper->addIdentifier('author');
		$listMapper->addIdentifier('heart_count');
		$listMapper->addIdentifier('image_filename');
		$listMapper->addIdentifier('createdAt');
		$listMapper->addIdentifier('updateAt');
	}
}