<?php

class Printer extends CApplicationComponent
{
	public $params = array();

	public function printH2P($html, $css, $outname){
		$mPDF = Yii::app()->ePdf->mpdf('utf-8', 'A4', '16', 'Arial', 10, 5, 7, 7, 10, 10);
		$mPDF->charset_in = 'utf-8';

		$mPDF->showImageErrors = true;
 		$mPDF->WriteHTML($css, 1);
		$mPDF->list_indent_first_level = 0; 
		$mPDF->WriteHTML($html, 2);
		$mPDF->Output($outname.'.pdf', 'D');
	}

	public function printPDF($data, $type, $lang, $outname){
		$html = $this->getTemplate("$type.$lang");
		$html = $this->parseTemplate($data, $html);
		$mPDF = Yii::app()->ePdf->mpdf('utf-8', 'A4', '16', 'Arial', 10, 5, 7, 7, 10, 10);
		$mPDF->charset_in = 'utf-8';

		$stylesheet = $this->getCSS($type);
 		$mPDF->WriteHTML($stylesheet, 1);

		$mPDF->list_indent_first_level = 0; 
		$mPDF->WriteHTML($html, 2);
		$mPDF->Output($outname.'.pdf', 'D');
	}

	public function printHTML($data, $type, $lang){
		$html = $this->getTemplate("$type.$lang");
		$html = $this->parseTemplate($data, $html);
		$html = "<style>\n".$this->getCSS($type)."\n</style>".$html;
		return $html;
	}

	private function parseTemplate($data, $template){
		foreach(array_keys($data) as $el){
			if(!strpos($template, $el)===FALSE){
				$template=str_replace("\${".$el."}",$data[$el],$template);
			}
		}
		return $template;		
	}

	private function getCSS($type){
		$css = file_get_contents(YiiBase::getPathOfAlias($this->params['templates'])."/css/".$type.".css");
		return $css;
	}

	private function getTemplate($name){
		$html = file_get_contents(YiiBase::getPathOfAlias($this->params['templates'])."/templates/".$name.".tpl.html");
		return $html;
	}

}
