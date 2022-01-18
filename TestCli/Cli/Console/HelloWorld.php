<?php
namespace TestCli\Cli\Console;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
 
class HelloWorld extends Command
{
   const NAME = 'name';
 
   protected function configure()
   {
       

    $commandoptions = [new InputOption(self::NAME, null, InputOption::VALUE_REQUIRED, 'name')];

       $this->setName('TestCli:HelloWorld');
       $this->setDescription('first console command ');
       $this->setDefinition($commandoptions);
       
      
       parent::configure();
   }
   protected function execute(InputInterface $input, OutputInterface $output)
   {
       
    if ($customname = $input->getOption(self::NAME))
    {
      $output->writeln("Hello ".$customname);
    }
    else
    {
      $output->writeln("Hello World");
    }
    
   }
}