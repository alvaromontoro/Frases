<?php

// not the best approach :(
$LESSON_DIR = "../lessons/";

class Settings {
	public $settings = array();
	
	public function __construct() {
	}
	
	public static function load($file) {
		$file = file_get_contents($file);
		return json_decode($file);
	}
	
	public static function save() {
		file_put_contents("settings", json_encode($this->settings));
	}
}

class Lesson {
	public $filename = "";
	public $title = "";
	public $active = true;
	public $sentences = array();
	public $order = 0;
	
	public function __construct($filename = "", $title = "", $active = true, $order = 0, $sentences = []) {
		$this->filename = $filename;
		$this->title = $title;
		$this->active = $active;
		$this->sentences = $sentences;
		$this->order = $order;
	}
	
	public function load($filename) {
		global $LESSON_DIR;
		if (file_exists($LESSON_DIR . $filename)) {
			$file = file_get_contents($LESSON_DIR . $filename);
			$data = json_decode($file);
			$this->filename = $data->filename;
			$this->title = $data->title;
			$this->active = $data->active;
			$this->sentences = $data->sentences;
			$this->order = $data->order;
		}
	}
	
	public function save() {
		global $LESSON_DIR;
		$data = json_encode($this);
		file_put_contents($LESSON_DIR . $this->filename, $data);
	}
	
	public static function loadLessons() {
		
		global $LESSON_DIR;
		
		$lessons = array();
		$files = scandir($LESSON_DIR);
		
		foreach($files as $filename) {
			if ($filename != "." && $filename != "..") {
				$file = file_get_contents($LESSON_DIR . $filename);
				$data = json_decode($file);
				$lessons[] = new Lesson($data->filename, $data->title, $data->active, $data->order, $data->sentences);
			}
		}
		
		usort($lessons, "Lesson::compareLessons");
			
		return $lessons;
	}
	
	private static function compareLessons($a, $b) {
		if ($a->order != $b->order)
			return $a->order < $b->order;
		return $a->title >= $b->title;
	}
}
