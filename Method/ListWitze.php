<?php
namespace GDO\Mettwitze\Method;

use GDO\Table\MethodQueryList;
use GDO\Mettwitze\GDO_Mettwitz;
use GDO\Core\GDT_Response;
use GDO\Form\GDT_Form;
use GDO\UI\GDT_SearchField;
use GDO\Core\GDO;
use GDO\Util\Common;
use GDO\UI\GDT_Paragraph;

final class ListWitze extends MethodQueryList
{
	public function gdoTable()
	{
		return GDO_Mettwitz::table();
	}
	
	public function getQuery()
	{
 		$query = parent::getQuery(); #->orderDESC('mw_created');
 		if (!isset($_REQUEST['o']))
 		{
 			$query->orderDESC('mw_created');
 		}
		
		if ($search = Common::getFormString('search'))
		{
			$search = GDO::escapeSearchS($search);
			$query->where("mw_question LIKE '%$search%' OR mw_answer LIKE '%$search%'");
		}
		
		return $query;
	}
	
	public function execute()
	{
		if ((@$_REQUEST['f']['list_page']) <= 1)
		{
			$paragraph = GDT_Paragraph::make()->text('paragraph_mettwitze');
			$form = GDT_Form::makeWith(GDT_SearchField::make('search'));
			return GDT_Response::makeWith($paragraph, $form)->add(parent::execute());
		}
		return parent::execute();
	}
	
}
