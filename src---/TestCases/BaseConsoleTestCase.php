<?php

namespace Untek\Framework\ConsoleTest\TestCases;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

abstract class BaseConsoleTestCase extends TestCase
{
    protected string $endpointScript;

    protected function runCommand(array $command, ?callable $callback = null): Process
    {
        $defaultCommand = [
            'php',
            $this->endpointScript
        ];
        $command = array_merge($defaultCommand, $command);
        $command[] = '--mode=test';
        $process = new Process($command);
        $process->run($callback);
        return $process;
    }
}
