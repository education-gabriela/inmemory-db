<?php

namespace Gabidavila\DB;

/**
 * Class MemoryDB
 * @package Gabidavila\DB
 */
class MemoryDB
{
    private $storage;
    private $available_commands = array('GET', 'SET', 'UNSET', 'NUMEQUALTO', 'FLUSH', 'END');

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function exec()
    {
        $handle = fopen("php://stdin", "r");
        $line = preg_replace('/\s+/', ' ', fgets($handle));
        return $this->query($line);
    }

    public function query($command)
    {
        $command = array_map('trim', explode(' ', $command));

        switch ($command[0]) {
            case 'SET':
                $this->storage->set($command[1], $command[2]);
                return true;
            case 'GET':
                echo $this->storage->get($command[1]) . PHP_EOL;
                return true;
            case 'UNSET':
                $this->storage->remove($command[1]);
                return true;
            case 'NUMEQUALTO':
                echo $this->storage->countValues($command[1]) . PHP_EOL;
                return true;
            case 'END':
                return false;
                break;
            default:
                throw new \Exception('Unnable to parse the informed command: ' . implode(' ', $command) .
                    PHP_EOL . 'Available commands: ' . implode(', ', $this->available_commands));
                return true;
        }
    }

}