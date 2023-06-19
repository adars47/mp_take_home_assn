<?php

class CategoryTest extends \PHPUnit\Framework\TestCase
{

    private $category;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->category = new App\CategoryTree();
    }

    public function testCategoryAddRoot()
    {
        $this->category->addCategory("A");
        $found = false;
        foreach($this->category->roots as $root)
        {
            if($root->identifier=="A")
            {
                $found = true;
            }
        }
        $this->assertTrue($found);
    }

    public function testAddMultipleRoot()
    {
        $this->category->addCategory("A");
        $this->category->addCategory("B");
        $foundA = false;
        $foundB = false;
        foreach($this->category->roots as $root)
        {
            if($root->identifier=="A")
            {
                $foundA = true;
            }

            if($root->identifier=="B")
            {
                $foundB = true;
            }
        }
        $this->assertTrue($foundA && $foundB);
    }

    public function testDuplicateInsertionValidation()
    {
        $this->expectException(App\Exception\InvalidArgumentException::class);
        $this->category->addCategory("B");
        $this->category->addCategory("B");
    }

    public function testNestedChildren()
    {
        $b = null;
        $this->category->addCategory("B");
        $this->category->addCategory("C","B");
        foreach($this->category->roots as $root)
        {
            if($root->identifier=="B")
            {
                $b= $root;
            }
        }

        $this->assertTrue($b!=null);

        $c = false;
        foreach($b->children as $child)
        {
            if($child->identifier=="C")
            {
                $c = true;
            }
        }
        $this->assertTrue($c);
    }
}