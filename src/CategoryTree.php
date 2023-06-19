<?php
namespace App;
use App\Exception\InvalidArgumentException;
use App\DataStructure\Node;
/**
 * NOTES:
 * ASSUMPTION:
 * There can be multiple trees (eg: multiple root nodes and duplicates will be flagged across all nodes)
 */
class CategoryTree
{
    public $roots = [];
    private $identifiers= [];

    /**
     * @throws InvalidArgumentException
     */
    public function addCategory(string $category, string $parent = null): void
    {
        //if it is already in the identifiers array, that category already exists
        if(in_array($category,$this->identifiers))
        {
            throw new InvalidArgumentException();
        }


        //if parent does not exist it is a root node
        if($parent==null)
        {
            $node = new Node($category,$parent);
            $this->roots[] = $node;
            $this->identifiers[]=$category;
            return ;
        }

        //if it is not a parent need to find parent and assign new node as a child
        $parent = $this->findParent($parent);
        $parent->addChildren($category,$parent);
        $this->identifiers[]=$category;

    }

    /**
     * @throws InvalidArgumentException
     */
    public function getChildren(string $parent): array
    {
        $parent = $this->findParent($parent);
        return $parent->getChildren($parent);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function findParent(string $category): ?Node
    {
        $parent = null;
        //validate if parent exists
        foreach($this->roots as $root)
        {
            $parent = $root->findNode($category);
            if($parent!=null)
            {
                return $parent;
            }
        }
        throw new InvalidArgumentException();
    }
}
