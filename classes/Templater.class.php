<?php 

class Templater {
  var $currentTemplate;
  var $template_path;

  public function Templater($currentTemplate) {
    $this->currentTemplate = $currentTemplate;
    $this->template_path = $_SERVER['DOCUMENT_ROOT']."/templates/";

    $this->errorHandler();
  }

  public function render(){
    $this->getHeader();
    $this->callTemplate($this->currentTemplate);
    $this->getFooter();
  }

  private function callTemplate($template) {
    require($this->template_path.$template.".inc.php");
  }

  private function getHeader() {
    $this->callTemplate("header");
  }

  private function getFooter() {
    $this->callTemplate("footer");
  }

  private function errorHandler(){
    if (!is_file($this->template_path.$this->currentTemplate.".inc.php")) 
      throw new Exception("Template doesnt exist");
  }

}

?>

