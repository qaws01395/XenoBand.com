<?php

class message {
	public $name;
	public $time;
	public $message;

	public function __construct($name, $time, $message) {
		$this->name = $name;
		$this->time = $time;
		$this->message = $message;
	}

	public function gethtml() {
		$html = "";
		// $html.= "<message style='color:#555555; font 10px'>";
		$html.= "<message>";
		// time
	    $html.= "<span class='text-muted bg-info'>";
		$html.= $this->time;
		$html.= "</span>";
		$html.= " ";
		// name
		$html.= "<span class='text-primary'>";
		$html.= $this->name;
		$html.= "</span>";
		$html.= "<br>";
		// message
		$html.= $this->message;
		$html.= "</message>";
		return $html;
	}

	public function getraw() {
		$raw = "";
		// $raw.= $this->time;
		// $raw.= " ";
		$raw.= "[";
		$raw.= $this->name;
		$raw.= "]";
		$raw.= " ";
		$raw.= $this->message;
		return $raw;
	}
}

?>
