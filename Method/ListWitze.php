<?php
namespace GDO\Mettwitze\Method;

use GDO\Table\MethodQueryList;
use GDO\Mettwitze\GDO_Mettwitz;
use GDO\Core\GDT_Response;
use GDO\UI\GDT_Panel;
use GDO\Form\GDT_Form;
use GDO\UI\GDT_SearchField;
use GDO\Core\GDO;
use GDO\Util\Common;

final class ListWitze extends MethodQueryList
{
	public function gdoFilters()
	{
		return $this->gdoTable()->gdoColumnsExcept();
	}
	
	public function gdoTable()
	{
		return GDO_Mettwitz::table();
	}
	
	public function gdoQuery()
	{
 		$query = parent::gdoQuery(); #->orderDESC('mw_created');
 		if (!isset($_REQUEST['o']))
 		{
 			$query->orderDESC('mw_created');
 		}
		
		if ($search = Common::getFormString('search'))
		{
			$search = GDO::escapeS($search);
			$query->where("mw_question LIKE '%$search%' OR mw_answer LIKE '%$search%'");
		}
		
		return $query;
	}
	
	public function execute()
	{
		if ((@$_REQUEST['f']['list_page']) <= 1)
		{
			$paragraph = GDT_Panel::withHTML(t('paragraph_mettwitze'));
			$form = GDT_Form::makeWith(GDT_SearchField::make('search'));
			return GDT_Response::makeWith($paragraph, $form)->add(parent::execute());
		}
		return parent::execute();
	}
	
}
