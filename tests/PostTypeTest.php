<?php

// tests/Form/Type/TestedTypeTest.php
namespace App\Tests;

use App\Form\CommentType;
use App\Entity\Comment;

use Symfony\Component\Form\Test\TypeTestCase;

class PostTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'content' => 'test test test test test test',
            ];

        $objectToCompare = new Comment();
// $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(CommentType::class, $objectToCompare);

        $object = new Comment();
// ...populate $object properties with the data stored in $formData

// submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

// check that $objectToCompare was modified as expected when the form was submitted
        $this->assertNotEquals($objectToCompare, $object);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
