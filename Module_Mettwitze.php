<?php
namespace GDO\Mettwitze;

use GDO\Core\GDO_Module;
use GDO\DB\GDT_Checkbox;
use GDO\UI\GDT_Bar;
use GDO\UI\GDT_Link;

/**
 * A website for Mettwitze. (gdo6 demo site :)
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 * @see GDO_Mettwitz
 */
final class Module_Mettwitze extends GDO_Module
{
	##############
	### Module ###
	##############
	public $module_priority = 90; # init very late. 50 is default. 10 for core stuff like jquery or db / core / log.
	
	public function getTheme() { return 'mettwitze'; } # own theme for tpl overrides @see thm folder.
	public function onLoadLanguage() { return $this->loadLanguage('lang/mettwitze'); }
	public function getDependencies() { return ['BootstrapTheme', 'Comment', 'Vote', 'Login', 'Register', 'Admin', 'Recovery', 'Account', 'Profile', 'Sitemap']; }
	public function getClasses()
	{
		# Entity tables
		return array(
			"GDO\\Mettwitze\\GDO_Mettwitz",
			"GDO\\Mettwitze\\GDO_MettwitzVote",
			"GDO\\Mettwitze\\GDO_MettwitzComments",
		);
	}
	
	##############
	### Config ###
	##############
	public function getConfig()
	{
		return array(
			GDT_Checkbox::make('allow_guest_jokes')->initial('1'),
			GDT_Checkbox::make('allow_guest_votes')->initial('1'),
			GDT_Checkbox::make('allow_comments')->initial('1'),
			GDT_Checkbox::make('allow_guest_comments')->initial('1'),
		);
	}
	public function cfgGuestJokes() { return $this->getConfigValue('allow_guest_jokes'); }
	public function cfgGuestVotes() { return $this->getConfigValue('allow_guest_votes'); }
	public function cfgComments() { return $this->getConfigValue('allow_comments'); }
	public function cfgGuestComments() { return $this->getConfigValue('allow_guest_comments'); }
	
	#############
	### Hooks ###
	#############
	public function hookTopBar(GDT_Bar $bar)
	{
		$bar->addField(GDT_Link::make('lbl_mettwitze')->href(href('Mettwitze', 'ListWitze')));
	}
	
	public function hookLeftBar(GDT_Bar $bar)
	{
// 		$bar->addField(GDT_Link::make('link_witze')->href(href('Mettwitze', 'ListWitze')));
		$bar->addField(GDT_Link::make('link_witze_all')->href(href('Mettwitze', 'ListWitze', '&o[mw_created]=1')));
		$bar->addField(GDT_Link::make('link_witze_new')->href(href('Mettwitze', 'ListWitze', '&o[mw_created]=0')));
		$bar->addField(GDT_Link::make('link_witze_best')->href(href('Mettwitze', 'ListWitze', '&o[mw_rating]=0&o[mw_votes]=0')));
		$bar->addField(GDT_Link::make('link_witze_rand')->href(href('Mettwitze', 'Random')));
		$bar->addField(GDT_Link::make('link_add_witz')->href(href('Mettwitze', 'CRUD')));
	}
	
	public function onIncludeScripts()
	{
		$this->addJavascript('js/mettwitze.js');
	}
}
