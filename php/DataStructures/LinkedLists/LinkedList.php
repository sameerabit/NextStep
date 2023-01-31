<?php

class Node
{
    private ?Node $next = null;
    private int $data;

    function __construct(int $data)
    {
        $this->data = $data;
    }

    function appendToTail(int $d)
    {
        $end = new Node($d);
        $n = $this;
        while ($n->next != null) {
            $n = $n->next;
        }
        $n->next = $end;
    }

    function deleteNode(Node $head, int $d)
    {
        $n = $head;

        if ($n->data == $d) {
            return $head->next;
        }

        while ($n->next != null) {
            if ($n->next->data == $d) {
                $n->next = $n->next->next;
                return $head;
            }
            $n = $head->next;
        }
        return $head;
    }

    function sortNodes()
    {
    }
}

$start = new Node(10);
$start->appendToTail(30);
$start->appendToTail(50);
$start->appendToTail(30);
$start->appendToTail(20);
$start->appendToTail(30);
$start->appendToTail(40);
print_r($start);
// $start->deleteNode($start, 30);
// print_r($start);
