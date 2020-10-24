<?php
namespace GDO\Mettwitze\Method;

use GDO\Table\MethodQueryList;
use GDO\Mettwitze\GDO_Mettwitz;
use GDO\Core\GDT_Response;
use GDO\Table\GDT_PageMenu;
use GDO\Table\GDT_List;
use GDO\UI\GDT_Bar;
use GDO\UI\GDT_Button;

final class Random extends MethodQueryList
{
	public function gdoTable() { return GDO_Mettwitz::table(); }
	public function isPaginated() { return false; }
	
	protected function setupTitle(GDT_List $list)
	{
		$list->title(t('list_random', [$this->gdoParameter('ipp')->ipp]));
	}

	public function gdoParameters()
	{
		return array(
			GDT_PageMenu::make('ipp')->ipp('1'),
		);
	}
	
	public function gdoQuery()
	{
		return $this->gdoTable()->select()->first()->debug()->orderASC("rand()");
	}
	
	public function execute()
	{
		$more = GDT_Response::makeWith(
			GDT_Bar::make()->horizontal()->addField(
				GDT_Button::make('link_more_random_mett')->noFollow()->href(href('Mettwitze', 'Random'))
			)
		);
		return parent::execute()->add($more);
	}

}
