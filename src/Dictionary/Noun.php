<?php

namespace Skyeng\Dictionary;

use Skyeng\Dictionary\FindIrregularBaseBehavior\IrregularBaseFinder;
use Skyeng\Dictionary\FindRegularBaseBehavior\NounRegularBaseFinder;
use Skyeng\Lemma;

class Noun extends PartOfSpeech {
  public function __construct() {
    $this->findIrregularBaseBehavior = new IrregularBaseFinder($this);
    $this->findRegularBaseBehavior = new NounRegularBaseFinder($this);
  }

  /**
   * @inheritdoc
   */
  public function getPartOfSpeech() {
    return Lemma::POS_NOUN;
  }

  /**
   * @inheritdoc
   */
  protected function doGetData() {
    return require __DIR__ . "/Config/list.noun.php";
  }

  /**
   * @inheritdoc
   */
  protected function doGetExceptionsData() {
    return require __DIR__ . "/Config/exceptions.noun.php";
  }
}
