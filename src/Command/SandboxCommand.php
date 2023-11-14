<?php

namespace App\Command;

use App\DependencyInjection\ContainerBagInterfaceDI;
use App\DependencyInjection\MetricsServiceDI;
use App\DependencyInjection\NotificationServiceDI;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:sb',
    description: 'Add a short description for your command',
)]
class SandboxCommand extends Command
{
    use MetricsServiceDI;
    use NotificationServiceDI;
    use ContainerBagInterfaceDI;

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        return Command::SUCCESS;
    }
}
