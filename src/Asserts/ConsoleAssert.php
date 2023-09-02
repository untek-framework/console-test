<?php

namespace Untek\Framework\ConsoleTest\Asserts;

use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use PHPUnit\Framework\Assert;
use Symfony\Component\Process\Process;

class ConsoleAssert extends Assert
{
    use ArraySubsetAsserts;

    protected Process $process;

    public function __construct(Process $process)
    {
        $this->process = $process;
    }

    public function assertIsError() {
        $this->assertNotEquals(0, $this->process->getExitCode());
    }

    public function assertIsSuccess() {
        $this->assertEquals(0, $this->process->getExitCode());
    }

    public function assertContainsError(string $needle)
    {
        $this->assertIsError();
        $content = $this->process->getErrorOutput() ?: $this->process->getOutput();
        $this->assertNotEmpty($content);
        $this->assertStringContainsString($needle, $content);
        return $this;
    }

    public function assertContainsOutput(string $needle)
    {
        $this->assertIsSuccess();
        $content = $this->process->getOutput();
        $this->assertStringContainsString($needle, $content);
        return $this;
    }
}
