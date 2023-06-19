<?php
//loading dependencies
use App\DataStructure\Node;

include_once ("vendor/autoload.php");

$c = new App\CategoryTree();
$c->addCategory('A', NULL);
$c->addCategory('B', 'A');
$c->addCategory('C', 'A');
$c->addCategory('D', 'C');
$c->addCategory('E', 'C');
$c->addCategory('F', 'C');
$c->addCategory('G', 'C');
$c->addCategory('X', NULL);
$c->addCategory('Y', 'X');
$c->addCategory('Z1', 'Y');
$c->addCategory('Z2', 'Y');
//$c->addCategory('Z2', 'A'); // InvalidArgumentException
//$c->addCategory('W', 'V'); // InvalidArgumentException
echo implode(',', $c->getChildren('A')) . PHP_EOL; //B,C
echo implode(',', $c->getChildren('C')) . PHP_EOL; //D,E,F,G
echo implode(',', $c->getChildren('Y')) . PHP_EOL; //Z1,Z2

/**
 * Function used to traverse the tree and check nodes
 * @param Node $node
 * @return void
 */
function traverse(Node $node)
{
    echo("Node name : ". $node->identifier."\n");
    foreach($node->children as $child)
    {
        traverse($child);
    }
}