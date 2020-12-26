<?php
namespace GDO\Mettwitze\Method;

use GDO\Table\MethodQueryList;
use GDO\Mettwitze\GDO_Mettwitz;
use GDO\Core\GDT_Response;
use GDO\UI\GDT_Paragraph;

/**
 * List of Mettwitze.
 * @author gizmore
 * @version 6.10
 * @since 6.09
 */
final class ListWitze extends MethodQueryList
{
	public function gdoTable()
	{
		return GDO_Mettwitz::table();
	}
	
	public function gdoHeaders()
	{
	    return $this->gdoTable()->getGDOColumns([
	        'mw_question', 'mw_answer', 'mw_votes', 'mw_rating', 'mw_creator', 'mw_created']);
	}
	
	public function getDefaultOrder() { return 'mw_created'; }
	public function getDefaultOrderDir() { return false; }
	
	public function execute()
	{
		if ((@$_REQUEST['o1']['page']) <= 1)
		{
			$paragraph = GDT_Paragraph::make()->text('paragraph_mettwitze');
			return GDT_Response::makeWith($paragraph)->add(parent::execute());
		}
		return parent::execute();
	}
	
}
