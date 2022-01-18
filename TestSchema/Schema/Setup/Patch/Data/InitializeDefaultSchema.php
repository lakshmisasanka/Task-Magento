<?php declare(strict_types=1);
namespace TestSchema\Schema\Setup\Patch\Data;


use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;



class InitializeDefaultSchema implements DataPatchInterface{ 

private $moduleDataSetup;

public function __construct(ModuleDataSetupInterface $moduleDataSetup)
{
    $this->moduleDataSetup = $moduleDataSetup;
}


public static function getDependencies()
{
    return [];
}

public function getAliases()
{
    return [];
}

public function apply()
{
    $tests = [
        ['schema_name' => 'testa', 'description' => 'this is testa'],
        ['schema_name' => 'testb', 'description' => 'this is testb'],
        ['schema_name' => 'testc', 'description' => 'this is testc'],
    ];
    $records = array_map(function ($test){
        return array_merge($test, ['is_enabled' =>1]);
    },$tests);

    $this->moduleDataSetup->getConnection()->insertMultiple('testschema_schema',$records);
    return $this;
}

}
