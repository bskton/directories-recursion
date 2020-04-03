<?php
$directory = new RecursiveDirectoryIterator($argv[1]);
$filter = new SimpleRecursiveFilterIterator($directory);
$iterator = new RecursiveIteratorIterator($filter);

$sum = 0;
foreach ($iterator as $item) {
    if ($item->getFileName() === 'count') {
        $sum += floatval(file_get_contents($item));
    }
}
var_dump($sum);

class SimpleRecursiveFilterIterator extends RecursiveFilterIterator {
    public function accept()
    {
        if ($this->current()->getFileName() === 'count') {
            return true;
        }

        if ($this->current()->isDir() && $this->current()->getFileName() !== '..') {
            return true;
        }

        return false;
    }
}