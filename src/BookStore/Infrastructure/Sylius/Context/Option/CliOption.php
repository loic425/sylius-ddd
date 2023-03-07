<?php


declare(strict_types=1);

namespace App\BookStore\Infrastructure\Sylius\Context\Option;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CliOption
{
    public function __construct(
        private Command $command,
        private InputInterface $input,
        private OutputInterface $output
    ) {
    }

    public function command(): Command
    {
        return $this->command;
    }

    public function input(): InputInterface
    {
        return $this->input;
    }

    public function output(): OutputInterface
    {
        return $this->output;
    }
}
