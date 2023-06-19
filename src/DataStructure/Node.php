<?php

namespace App\DataStructure;

class Node
{
    public string $identifier;
    public ?Node $parent;
    public array $children=[];

    public function __construct(string $identifier,$parent=null)
    {
        $this->identifier = $identifier;
        $this->parent = $parent;
    }

    public function addChildren(String $identifier,$parent=null)
    {
        $this->children[]=new Node($identifier,$parent);
    }

    public function getChildren($parent): array
    {
        $return_arr = [];
        foreach($parent->children as $child)
        {
            $return_arr[]= $child->identifier;
        }
        return $return_arr;
    }

    public function findNode(string $identifier)
    {
        if ($identifier == $this->identifier)
        {
            return $this;
        }

        foreach($this->children as $child)
        {
            $fnode = $child->findNode($identifier);
            if($fnode!=null)
            {
                return $fnode;
            }
        }
        return null;
    }
}