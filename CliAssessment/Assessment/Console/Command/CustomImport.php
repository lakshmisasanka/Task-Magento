<?php
namespace CliAssessment\Assessment\Console\Command;
 
use Symfony\Component\Console\Command\Command;
use Magento\Framework\App\State;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\ImportExport\Model\ImportFactory;
use Magento\ImportExport\Model\Import\Source\CsvFactory;
use Magento\Framework\Filesystem\Directory\ReadFactory;
 
class CustomImport extends Command
{
   
   
    private $state;
 
   
    protected $importFactory;
 
   
    private $csvSourceFactory;
 
   
    private $readFactory;
 
    
    public function __construct(
      State $state,
      ImportFactory $importFactory,
      CsvFactory $csvSourceFactory,
      ReadFactory $readFactory
    ) {
        $this->state = $state;
        $this->importFactory = $importFactory;
        $this->csvSourceFactory = $csvSourceFactory;
        $this->readFactory = $readFactory;
        parent::__construct();
    }
 
    
    protected function configure()
    {
        $this->setName('customer:importer');
        $this->setDescription('Imports Customer into Magento from a CSV');
        $this->addArgument('import_path', InputArgument::REQUIRED, 'The path of the import file (ie. ../../path/to/file.csv)');
        $this->addOption('profile',null, InputOption::VALUE_OPTIONAL, 'csv');
        parent::configure();
    }
 
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
       
        try {
            $this->state->setAreaCode('adminhtml');
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            
        }
 
        $import_path = $input->getArgument('import_path');
        $import_file = pathinfo($import_path);
 
        $import = $this->importFactory->create();
        $import->setData(
            array(
                'entity' => 'customer',
                'behavior' => 'append',
                'validation_strategy' => 'validation-stop-on-errors',
            )
        );
 
        $read_file = $this->readFactory->create($import_file['dirname']);
     
        $csvSource = $this->csvSourceFactory->create(
            array(
                'file' => $import_file['basename'],
                'directory' => $read_file,
            )
        );
       
        
 
        $result = $import->importSource();
        if ($result) {
          $import->invalidateIndex();
        }
 
        $output->writeln("<info>Finished importing products from $import_path</info>");
    }
  
}