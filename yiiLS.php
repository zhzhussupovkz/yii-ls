<?php

/*
* yiiLS - simple content slider for Yii
* @author Zhussupov Zhassulan <zhzhussupovkz@gmail.com>
* @version: 1.0
* MADE IN KAZAKHSTAN
*/

class yiiLS extends CWidget {

	//id
	public $id;

	//slides - title and content
	public $slides = array();

	//options at http://liquidslider.com
	public $options = array();

	//run the widget
	public function run() {
		$this->assetsFolder();

		echo '<div class="liquid-slider"  id="'.$this->id.'">';

		foreach ($this->slides as $item) {
			echo '<div>';
			echo '<h2 class = "title">'.$item['title'].'</h2>';
			echo $item['content'];
			echo '</div>';
		}

		echo '</div>';

		$script = '$(function(){
			$("#'.$this->id.'").liquidSlider('.CJavaScript::encode($this->options, false).');
		});';

		Yii::app()->clientScript->registerScript('yiiLS', $script, CClientScript::POS_HEAD);
	}

	//access scripts
	protected function assetsFolder() {
		$assets = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
		$baseUrl = Yii::app()->assetManager->publish($assets);
		if(is_dir($assets)) {
			Yii::app()->clientScript->registerCoreScript('jquery');
			Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.liquid-slider.min.js');
			Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.touchSwipe.min.js');
			Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.easing.1.3.js');
			Yii::app()->clientScript->registerCssFile($baseUrl.'/css/liquid-slider.css');
		}
		else {
			throw new Exception('Error in yiiLS widget! Cannot access assets folder');
		}
	}
}