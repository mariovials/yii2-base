<?php

namespace common\widgets;

use common\helpers\Html;
use common\assets\QuillAsset;
use yii\helpers\StringHelper;

/**
 *
 */
class ActiveField extends \yii\widgets\ActiveField
{
  public function dropDownList($items, $options = []) {
    Html::addCssClass($this->options, ['class' => 'select']);
    return parent::dropDownList($items, $options);
  }

  public function textarea($options = []) {
    Html::addCssClass($this->options, ['class' => 'textarea']);
    return parent::textarea($options);
  }

  public function hiddenInput($options = []) {
    Html::addCssClass($this->options, ['class' => 'hidden']);
    return parent::hiddenInput($options);
  }

  public function radiolist($items, $options = []) {
    Html::addCssClass($this->options, ['class' => 'radiolist']);
    return parent::radiolist($items, $options);
  }

  /**
   * El método es identico, sólo que utiliza la clase Html propia
   * @author Mario Vial <mvial@ubiobio.cl> 14/06/2017 12:25
   * @inheritdoc
   */
  public function checkbox($options = [], $enclosedByLabel = true)
  {
    Html::addCssClass($this->options, ['class' => 'checkbox']);
    $this->addAriaAttributes($options);
    $this->adjustLabelFor($options);
    if ($this->form->validationStateOn === ActiveForm::VALIDATION_STATE_ON_INPUT) {
      $this->addErrorClassIfNeeded($options);
    }
    $this->parts['{input}'] = Html::activeCheckbox($this->model, $this->attribute, $options);
    $this->parts['{label}'] = '';
    return $this;
  }

  public function quillEditor()
  {
    Html::addCssClass($this->options, ['class' => 'ql']);
    QuillAsset::register($this->form->view);
    $quillVar = 'quill' . $this->model->modelName . ucfirst($this->attribute);
    $idHidden = "{$this->inputId}-field";
    $this->form->view->registerJs("
      let {$quillVar} = new Quill('#{$this->inputId}', { theme: 'snow' })
      {$quillVar}.on('text-change', () => {
        html = {$quillVar}.root.innerHTML
        if (html == '<p><br></p>') html = ''
        $('#$idHidden').val(html)
      });
    ");
    $this->parts['{input}'] = Html::tag('div',
      Html::tag('div', $this->model->{$this->attribute}, ['id' => $this->inputId]) .
      Html::activeHiddenInput($this->model, $this->attribute, ['id' => $idHidden]),
      ['class' => 'ql-wrapper']);
    return $this;
  }

  public function datalist($items, $options = [])
  {
    $this->parts['{input}'] = Html::activeDatalist($this->model, $this->attribute, $items, $options);
    return $this;
  }

  public function begin($content = null)
  {
    if (isset($this->model->modelName)) {
      $this->options['data']['model'] = $this->model->modelName;
    }
    return parent::begin($content);
  }

  public function label($label = null, $options = [])
  {
    if ($this->model->{$this->attribute} != null) {
      $this->labelOptions['class'] .= ' activo';
    }
    return parent::label($label, $options);
  }
}
