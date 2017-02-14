<?php

namespace Skyeng\Dictionary;

use Skyeng\Dictionary\FindIrregularBaseBehavior\IrregularBaseFinder;
use Skyeng\Dictionary\FindRegularBaseBehavior\AdjectiveRegularBaseFinder;
use Skyeng\Lemma;

class Adverb extends PartOfSpeech {
  public function __construct() {
    $this->findIrregularBaseBehavior = new IrregularBaseFinder($this);
    $this->findRegularBaseBehavior   = new AdjectiveRegularBaseFinder($this);
  }

  /**
   * @inheritdoc
   */
  public function getPartOfSpeech() {
    return Lemma::POS_ADVERB;
  }

  /**
   * @inheritdoc
   */
  protected function doGetData() {
    return require __DIR__ . "/Config/list.adverb.php";
  }

  /**
   * @inheritdoc
   */
  protected function doGetExceptionsData() {
    return require __DIR__ . "/Config/exceptions.adverb.php";
  }
}