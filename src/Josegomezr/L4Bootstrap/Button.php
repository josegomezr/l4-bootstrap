<?php namespace Josegomezr\L4Bootstrap;

class Button  extends MakeableObject {

	protected $displayName = "";
	protected $classes = array();
	protected $icon = null;
	protected $active = false;
	protected $enabled = true;
	protected $tag = "button";
	protected $attributes = array();
	protected $output;

	static function create($displayName="")
	{
		$that = new self();
		$that->tag = "a";
		$that->displayName = $displayName;
		$that->enabled = true;
		$that->components = ['before' => array(), 'after' => array()];
		return $that;
	}

	public function reset()
	{
		$this->tag = "button";
		$this->attributes["type"] = "reset";
		return $this;
	}

	public function submit()
	{
		$this->tag = "button";
		$this->attributes["type"] = "submit";
		return $this;
	}

	public function active($val)
	{
		$this->active = $val;
		return $this;
	}

	public function anchor($val)
	{
		$this->attributes['href'] = $val;
		return $this;
	}

	public function disabled($val)
	{
		if(in_array($this->tag, array('input', 'button'))){
			if($val){
				$this->attributes["disabled"] = $val;
				
			}else{
				unset($this->attributes['disabled']);
			}
		}
		$this->enabled = $val;
		return $this;
	}

	public function type($val)
	{
		$this->classes[] = 'btn-'. $val;
		return $this;
	}
	
	public function size($val)
	{
		$this->classes[] = 'btn-'. $val;
		return $this;
	}

	public function attach(MakeableObject $component, $position = "before")
	{
		$this->components[$position] = $component;
		return $this;
	}

	public function make()
	{
	
		$output = "";
		
		if(!$this->enabled)
			$this->classes[] = "disabled";

		if($this->active)
			$this->classes[] = "active";

		if($this->tag != "a" && isset($this->attributes["type"])){
			$this->attributes["type"] = "button";
		}

		$output .= '<' . $this->tag;
		$output .= ' class="btn ';
		$output .= is_array($this->classes) ? implode(' ', $this->classes) : '';
		$output .= '"';

		$output .= with(new \Illuminate\Html\HtmlBuilder)->attributes($this->attributes);
		$output .= '>';

		foreach ($this->components["before"] as $comp) {
			$output .= $comp->make();
		}
		
		$output .= $this->displayName;

		foreach ($this->components["after"] as $comp) {
			$output .= $comp->make();
		}

		$output .= '</'. $this->tag .'>';
		return $output;
	}


}