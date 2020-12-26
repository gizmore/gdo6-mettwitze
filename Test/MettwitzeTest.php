<?php
namespace GDO\Mettwitze\Test;

use GDO\Tests\TestCase;
use function PHPUnit\Framework\assertGreaterThanOrEqual;
use GDO\Mettwitze\Method\CRUD;
use GDO\Tests\MethodTest;
use GDO\Mettwitze\GDO_Mettwitz;
use GDO\Mettwitze\Method\ListWitze;
use GDO\Table\Module_Table;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertStringContainsString;

/**
 * The test data is in Module_Tests.
 * 
 * @author gizmore
 * @version 6.10
 */
final class MettwitzeTest extends TestCase
{
//     public function testLoadMettwitze()
//     {
//         $mod = Module_Tests::instance();
//         Database::instance()->parseSQLFile($mod->filePath('Test/data/mettwitze.sql'));
//         $count = GDO_Mettwitz::table()->countWhere();
//         assertGreaterThanOrEqual(300, $count);
//     }

    public function testCreation()
    {
        $m = CRUD::make();
        $p = [
            'mw_question' => 'Mettwitz 1 - Frage 1',
            'mw_answer' => 'Mettwitz 1 - Antwort 1',
        ];
        MethodTest::make()->method($m)->parameters($p)->execute();
        $this->assert200("Test if Mettwitz can be created.");
        
        $p = [
            'mw_question' => 'Mettwitz 2 - Frage 2',
            'mw_answer' => 'Mettwitz 2 - Antwort 2',
        ];
        MethodTest::make()->method($m)->parameters($p)->execute();
        $this->assert200("Test if Mettwitz 2 can be created.");
        
        $p = [
            'mw_question' => 'Mettwitz 3 - Frage 3',
            'mw_answer' => 'Mettwitz 3 - Antwort 3',
        ];
        MethodTest::make()->method($m)->parameters($p)->execute();
        $this->assert200("Test if Mettwitz 3 can be created.");
        
        $count = GDO_Mettwitz::table()->countWhere();
        assertGreaterThanOrEqual(3, $count, 'Test if 3 Mettwitze can be created.');
    }
    
    public function testPagemenu()
    {
        $mt = Module_Table::instance();
        $mt->saveConfigVar('ipp', '2');
        $ipp = $mt->cfgItemsPerPage();
        assertEquals('2', $ipp);
        
        $m = ListWitze::make();
        $gp = [
            'o1' => [
                'page' => 1,
            ],
        ];
        $p = [];
        $r = MethodTest::make()->method($m)->parameters($p)->getParameters($gp)->execute();
        $html = $r->render();
        assertStringContainsString('3 Mett', $html);
        assertStringContainsString('Frage 2', $html);

        $m = ListWitze::make();
        $o1 = $m->table->headers->name;
        $gp = [
            $o1 => [
                'page' => 2,
            ],
        ];
        $r = MethodTest::make()->method($m)->parameters($p)->getParameters($gp)->execute();
        $html = $r->render();
        assertStringContainsString('3 Mett', $html);
        assertStringContainsString('Frage 3', $html);
    }
    
}
