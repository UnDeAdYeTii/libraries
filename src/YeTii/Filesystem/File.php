<?php
 /**
  * @todo
  * @todo I have not finished yet. Likely to be buggy :p
  */
namespace YeTii\FileSystem;

use YeTii\General\Str;

class File {

	protected $exists;
	protected $is_dir;
	protected $has_children;

	protected $name;
	protected $full_path;
	protected $extension;

	protected $date_modified;

	protected $children_count;
	protected $children;

	protected $siblings_count;
	protected $siblings;

	protected $parent;

	protected $settings = [
		'show_hidden_files'=>true
	];

	public function __construct(string $path, array $settings = []) {
		$this->full_path = rtrim($path, '/');
		$this->settings = array_merge($this->settings, $settings);
		$this->init();
	}

	public function __get($name) {
		if (in_array($name, ['children','parent','siblings','children_count','siblings_count'])) {
			return $this->{$name}();
		}
	}

	public function __set($name, $val) {
		$this->{$name} = $val;
	}

	public function __call($name, $args) {
		if (method_exists($this, $name)) {
			return call_user_func_array([$this, $name], $args);
		}
	}

	private function init() {
		foreach (['name','extension','date_modified','children_count','children','parent','siblings_count','siblings'] as $key)
			$this->{$key} = null;
		$this->exists = file_exists($this->full_path)?1:0;
		$this->name = Str::afterLast($this->full_path, '/')->value;
		if ($this->exists) {
			$this->is_dir = is_dir($this->full_path)?1:0;
			if (!$this->is_dir) {
				$this->extension = Str::getExtension($this->name, '');
			}else{
				$this->children_count = 0;
				foreach (scandir($this->full_path) as $f)
					if ($f!='.'&&$f!='..'&& ($this->settings['show_hidden_files']||$f[0]!='.'))
						$this->children_count++;
				$this->has_children = $this->children_count?1:0;
			}
		}
	}

	private function children_count() {
		if (!$this->children)
			$this->children();
		return $this->children_count;
	}

	private function children() {
		if (!$this->is_dir)
			return false;
		$children = [];
		foreach (scandir($this->full_path) as $f) {
			if ($f=='.'||$f=='..') continue;
			if ($this->settings['show_hidden_files']||$f[0]!='.')
				$children[] = new File($this->full_path.'/'.$f, $this->settings);
		}
		$this->children = $children;
		$this->children_count = count($children); // updates these
		$this->has_children = count($children)?1:0; // updates these
		return $children;
	}

	private function child($key, $default = null) {
		if (!$this->children)
			$this->children();
		if (is_string($key)) {
			if (is_array($this->children)) {
				foreach ($this->children as $child) {
					if ($key == $child->name)
						return $child;
				}
			}
		}else{
			$key = (int)$key;
			if (isset($this->children[$key]))
				return $this->children[$key];
		}
		return $default;
	}

	private function parent() {
		$path = Str::beforeLast($this->full_path, '/');
		if ($path) {
			$this->parent = new File($path, $this->settings);
			return $this->parent;
		}else{
			return false;
		}
	}

	private function siblings() {
		$parent = $this->parent();
		$siblings = $parent->children();
		for ($i=0;$i<count($siblings);$i++) {
			if ($siblings[$i]->name == $this->name)
				unset($siblings[$i]);
		}
		$this->siblings = $siblings;
		$this->siblings_count = count($siblings);
		$this->has_siblings = count($siblings)?1:0;
		return $this->siblings;
	}

	private function siblings_count() {
		if (!$this->siblings)
			$this->siblings();
		return $this->siblings_count;
	}

	private function sibling($key, $default = null) {
		if (!$this->siblings)
			$this->siblings();
		if (is_string($key)) {
			if (is_array($this->siblings)) {
				foreach ($this->siblings as $sibling) {
					if ($key == $sibling->name)
						return $sibling;
				}
			}
		}else{
			$key = (int)$key;
			if (isset($this->siblings[$key]))
				return $this->siblings[$key];
		}
		return $default;
	}

	public function delete() {
		$this->filedelete($this->full_path);
	}

	private function filedelete($filename) {
		if (is_dir($filename)) {
			foreach (scandir($filename) as $f) {
				if ($f=='.'||$f=='..') continue;
				$this->filedelete(Str::parseDir($filename, $f));
			}
			rmdir($filename);
		}else{
			unlink($filename);
		}
	}

	public function rename($to, $keepExt = false) {
		$to = Str::parseDir($this->parent()->full_path, $to.($keepExt?".{$this->extension}":''));
		if (file_exists($to))
			return false;
		rename($this->full_path, $to);
		$this->init();
		return $this;
	}

	public function move($to, $sameParentPath = false) {
		if (is_object($to) && is_a($to, 'YeTii\FileSystem\File')) {
			$par = $to->parent();
			$to = !$to->exists || $to->is_dir ? $to->full_path : (isset($par->full_path) ? $par->full_path : null);
			$to = Str::parseDir($to, $this->name);
		}else{
			if ($sameParentPath) {
				$base = !$this->exists || $this->is_dir ? $this->full_path : $this->parent()->full_path;
				$to = Str::parseDir($base, $to);
			}
			$to = Str::parseDir($to, $this->name);
		}
		if (is_null($to))
			return false;
		rename($this->full_path, $to);
		$this->init();
		return $this;
	}

	// public function breadcrumbs() {
	// 	$crumbs = [];
	// 	$part = $this;
	// 	while(true) {
	// 		$part = $part->parent();
	// 		if (!$part->exi)
	// 		$crumbs[] = $part;
	// 		if (!Str::contains($part->full_path, '/'))
	// 			break;
	// 	}
	// 	$crumbs = array_reverse($crumbs);
	// 	return $crumbs;
	// }

}