<?php

namespace Skyeng\Dictionary;

use Skyeng\Dictionary\FindIrregularBaseBehavior\AbstractIrregularBaseFinder;
use Skyeng\Dictionary\FindRegularBaseBehavior\AbstractRegularBaseFinder;
use Skyeng\Lemma;
use Skyeng\Word;

abstract class PartOfSpeech {
  /**
   * @var array
   */
  protected $data;

  /**
   * @var array
   */
  protected $exceptions;

  /**
   * @var AbstractIrregularBaseFinder
   */
  protected $findIrregularBaseBehavior;

  /**
   * @var AbstractRegularBaseFinder
   */
  protected $findRegularBaseBehavior;

  /**
   * @return array
   */
  public function getData() {
    if(!$this->data) {
      $this->data = $this->doGetData();
    }

    return $this->data;
  }

  /**
   * @return array
   */
  public function getExceptions() {
    if(!$this->exceptions) {
      $this->exceptions = $this->doGetExceptionsData();
    }

    return $this->exceptions;
  }

  /**
   * @param Word $word
   *
   * @return null|Lemma
   */
  public function getIrregularBase(Word $word) {
    if($base = $this->findIrregularBaseBehavior->getIrregularBase($word)) {
      return new Lemma($base, $this->getPartOfSpeech());
    }

    return null;
  }

  /**
   * @param Word $word
   *
   * @return Lemma[]
   */
  public function getRegularBases(Word $word) {
    $lemmas = [];
    $bases = $this->findRegularBaseBehavior->getRegularBases($word);
    foreach($bases as $base) {
      $lemmas[] = new Lemma($base, $this->getPartOfSpeech());
    }

    return $lemmas;
  }

  /**
   * @return array
   */
  abstract protected function doGetData();

  /**
   * @return array
   */
  abstract protected function doGetExceptionsData();

  /**
   * @return string
   */
  abstract public function getPartOfSpeech();
}
