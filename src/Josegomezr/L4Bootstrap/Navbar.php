<?php namespace Josegomezr\L4Bootstrap;
/**
* 
*/

class Navbar
{
	private $output;
	protected $brand;
	protected $id;
	protected $elements = array();
	protected $autoroute;
	protected $hasAuthority;
	protected $brandDisplay;
	protected $brandLink;
	protected $prefix;
	protected $type;
	protected $position;
	
	static function create($autoroute = true, $prefix = "")
	{
		$that = new self();
		
		if (class_exists('\Authority') || class_exists('\Authority\AuthorityL4\Facades\Authority')) {
			$that->hasAuthority = true;
		}
		$that->id = "navbar";
		$that->prefix = $prefix;
		$that->autoroute = $autoroute;
		$that->hasBrand = false;
		return $that;
	}

	public function brand($name, $uri)
	{
		$this->hasBrand = true;
		$this->brandDisplay = $name;
		$this->brandLink = Helper::getLink($uri);
		return $this;
	}

	public function withID($id)
	{
		$this->id = !empty($id) ? $id : "navbar";
		return $this;
	}

	public function attach($element){
		$this->elements[] = $element;
		return $this;
	}

	public function position($type)
	{
		$this->position = "navbar-".$type;
		return $this;
	}
	public function type($type)
	{
		$this->type = "navbar-".$type;
		return $this;
	}

	public function make()
	{
		$this->output ="";
		$this->output .= <<<EOF
<nav class="navbar navbar-default {$this->type} {$this->position}" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#{$this->id}">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
EOF;
		if($this->hasBrand){

		$this->output .= <<<EOF
        <a class="navbar-brand" href="$this->brandLink">$this->brandDisplay</a>
EOF;
		}
		$this->output .= <<<EOF
    </div>
   <!-- Collect the nav links, forms, and other content for toggling -->
  	<div class="collapse navbar-collapse" id="{$this->id}">
EOF;
		foreach ($this->elements as $component) {
			if(property_exists($component, 'autoroute')){
				$component->autoroute = $this->autoroute;
				if(property_exists($component, 'prefix')){
					$component->prefix = $this->prefix;
				}
			}

			$this->output .= $component->make();
		}
	
		$this->output .= <<<EOF
	</div>
</nav>
EOF;
		return $this->output;
	}
}