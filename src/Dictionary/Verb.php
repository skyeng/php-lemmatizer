<?php

namespace Skyeng\Dictionary;

use Skyeng\Dictionary\FindIrregularBaseBehavior\IrregularBaseFinder;
use Skyeng\Dictionary\FindRegularBaseBehavior\VerbRegularBaseFinder;
use Skyeng\Lemma;

class Verb extends PartOfSpeech {
  public function __construct() {
    $this->findIrregularBaseBehavior = new IrregularBaseFinder($this);
    $this->findRegularBaseBehavior = new VerbRegularBaseFinder($this);
  }

  /**
   * @return string
   */
  public function getPartOfSpeech() {
    return Lemma::POS_VERB;
  }

  /**
   * @inheritdoc
   */
  protected function doGetData() {
    return require __DIR__ . "/Config/list.verb.php";
  }

  /**
   * @inheritdoc
   */
  protected function doGetExceptionsData() {
    return require __DIR__ . "/Config/exceptions.verb.php";
  }
}