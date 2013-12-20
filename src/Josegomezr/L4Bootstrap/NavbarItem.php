<?php namespace Josegomezr\L4Bootstrap;
/**
* 
*/

class NavbarItem
{
	protected $brand;
	protected $displayName;
	protected $href;
	protected $resource;
	protected $classes;
	protected $icon;
	protected $children;
	protected $active;
	protected $enabled;
	protected $iconAfterText;
	protected $output;


	static function create($displayName, $href="#", $resource=null, $children=array(), $icon = null, $iconAfterText = true)
	{

		$that = new self();
		$that->displayName = $displayName;
		$that->href = $href;
		$that->resource = $resource;
		$that->icon = $icon;
		if(count($children) > 0){
			foreach($children as $child){
				$that->children[] = call_user_func_array('NavbarItem::create', $child);
			}
			$classes[] = "dropdown";
		}
		$that->enabled = true;
		
		$that->iconAfterText = $iconAfterText;

		return $that;
	}

	public function setActive()
	{
		$this->active = true;
	}

	public function unsetActive()
	{
		$this->active = false;
	}
	
	public function setEnabled()
	{
		$this->enabled = true;
	}

	public function unsetEnabled()
	{
		$this->enabled = false;
	}

	public function make()
	{
		if($this->displayName == "<divider>"){
			$output = '<li class="divider"></li>';
			return $output;
		}

		$output = '<li class="';
		if(!$this->enabled){
			$output .= "disabled";
		}
		if($this->active){
			$output .= "active";
		}
		$output .= is_array($this->classes) ? implode(' ', $this->classes) : '';
		$output .=  '">';

		$output .= '<a ';
		if($this->enabled){
			$output .= 'href="';
			$output .= Helper::getLink($this->href);
			$output .= '"';
		}else{
			$output .= 'href="#"';
		}
		if(count($this->children)){
			$output .= 'class="dropdown-toggle" data-toggle="dropdown"';
		}
		$output .= '">';
		
		if($this->icon && !$this->iconAfterText){
			$output .= '<i class="glyphicon ' . $this->icon . '"></i> ';
		}

		$output .= $this->displayName;

		if($this->icon && $this->iconAfterText){
			$output .= ' <i class="glyphicon ' . $this->icon . '"></i>';
		}

		if(count($this->children)){
			$output .= '<b class="caret"></b>';
		}

		$output .= '</a>';
		if(count($this->children)){
			$output .= '<ul class="dropdown-menu">';
			foreach($this->children as $child){
				$output .= $child->make();
			}
			$output .= '</ul>';
		}
		$output .= '</li>';
		return $output;
	}


}