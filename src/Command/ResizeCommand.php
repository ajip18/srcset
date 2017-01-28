<?php

namespace wappr\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ResizeCommand extends Command
{
    protected function configure()
    {
        $this
        ->setName('srcset')
        ->setDescription('Create images for srcset')
        ->setHelp('This command will create multiple images for your srcset.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Resizing...');
    }
}
