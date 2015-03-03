<?php 

class Templater {
  var $currentModel;
  var $currentTemplate;

  var $templatePath;

  public function Templater($currentModel) {
    $this->currentModel = $currentModel;
    $this->templatePath = $_SERVER['DOCUMENT_ROOT']."/templates/";

    $this->errorHandler();
  }

  public function render(){
    if(!isset($this->currentTemplate)) 
      throw new Exception("No template has been selected");
    $this->getHeader();
    $this->callTemplate($this->currentTemplate);
    $this->getFooter();
  }

  public function setTemplate($template){
    $this->currentTemplate = $template;
  }

  private function callTemplate($template) {
    require($this->templatePath.$template.".inc.php");
  }

  private function getHeader() {
    $this->callTemplate("header");
  }

  private function getFooter() {
    $this->callTemplate("footer");
  }

  private function errorHandler(){
    if (!is_file($this->templatePath.$this->currentModel.".inc.php")) 
      throw new Exception("Template doesnt exist");
  }

}

?>

