<?php

namespace Skyeng\Dictionary\FindIrregularBaseBehavior;

use Skyeng\Dictionary\PartOfSpeech;
use Skyeng\Word;

abstract class AbstractIrregularBaseFinder {
  /**
   * @var PartOfSpeech
   */
  protected $partOfSpeech;

  /**
   * @param PartOfSpeech $partOfSpeech
   */
  public function __construct(PartOfSpeech $partOfSpeech) {
    $this->partOfSpeech = $partOfSpeech;
  }

  /**
   * @param Word $word
   *
   * @return null|string
   */
  abstract public function getIrregularBase(Word $word);
}