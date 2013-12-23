<?php namespace Josegomezr\L4Bootstrap;
/**
* 
*/

class NavMenu extends Component
{
	private $output;
	protected $brand;
	protected $id;
	protected $elements = array();
	public $autoroute;
	protected $hasAuthority;
	protected $classes = array();
	public $prefix;
	protected $type;
	protected $position;
	
	public function withID($id)
	{
		$this->id = !empty($id) ? $id : "navbar";
		return $this;
	}

	public function create($elements, $class = null, $autoroute = false, $prefix = "")
	{
		$that = new self();
		$that->autoroute = $autoroute;
		$that->prefix = $prefix;
		if(is_array($class)){
			array_merge($that->classes, $class);
		}else{
			if(strpos($class, ' ') !== FALSE){
				array_merge($that->classes, implode(' ', $class));
			}else{
				$that->classes[] = $class;
			}
		}
		$that->class = $class;
		foreach ($elements as $uri => $values) {
			$that->elements[$uri] = call_user_func_array('NavbarItem::create', $values);
		}
		
		return $that;
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
   		$this->output .= '<ul class="nav navbar-nav ';
   		$this->output .= (!empty($this->classes) ? implode(' ', $this->classes) :'');
   		$this->output .= '">';
		foreach ($this->elements as $uri => $elem) {
			if($this->autoroute && !is_numeric($uri)){
				if($uri == '/'){
					if(\Request::is($this->prefix)){
						$elem->setActive();
					}
				}else{
					if(\Request::is($this->prefix . "/" . $uri . "*")){
						$elem->setActive();
					}
				}
			}
			$this->output .= $elem->make();
		}
		$this->output .= '</ul>';
	
		return $this->output;
	}
	public function align($val){
		$this->classes[] = $val;
		return $this;
	}
	public function addClass($val){
		$this->classes[] = $val;
		return $this;
	}
	public function attach(Component $element){
		$this->components[] = $element;
		return $this;
	}
}