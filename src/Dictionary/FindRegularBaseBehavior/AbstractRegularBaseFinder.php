<?php

namespace Skyeng\Dictionary\FindRegularBaseBehavior;

use Skyeng\Dictionary\PartOfSpeech;
use Skyeng\Lemma;
use Skyeng\Word;

abstract class AbstractRegularBaseFinder {
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
   * @return string[]
   */
  protected function getMorphologicalSubstitutionBases(Word $word) {
    $bases = [];
    foreach($this->getMorphologicalSubstitutions() as list($morpho, $origin)) {
      if($word->isEndsWith($morpho)) {
        $bases[] = substr($word->asString(), 0, -strlen($morpho)) . $origin;
      }
    }

    return $bases;
  }

  /**
   * @param string[] $bases
   *
   * @return string[]
   */
  protected function filterValidBases(array $bases) {
    $result = [];
    foreach($bases as $base) {
      if($this->isValidBase($base)) {
        $result[] = $base;
      }
    }

    return $result;
  }

  /**
   * @param string $base
   *
   * @return bool
   */
  protected function isValidBase($base) {
    return strlen($base) > 1 && isset($this->partOfSpeech->getWordsList()[$base]) && $this->partOfSpeech->getWordsList()[$base] === $base;
  }

  /**
   * @param Word $word
   *
   * @return Lemma[]
   */
  abstract public function getRegularBases(Word $word);

  /**
   * @return array of arrays like [morpho, origin]
   */
  abstract protected function getMorphologicalSubstitutions();
}
