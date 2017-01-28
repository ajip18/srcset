<?php

namespace wappr\Command;

use wappr\Resize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ResizeCommand extends Command
{
    protected function configure()
    {
        $this
        ->setName('srcset')
        ->addArgument('filename', InputArgument::REQUIRED, 'The filename to resize.')
        ->setDescription('Create images for srcset')
        ->setHelp('This command will create multiple images for your srcset.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Resizing...');
        $filename = $input->getArgument('filename');
        $resizer = new Resize($filename);
    }
}
