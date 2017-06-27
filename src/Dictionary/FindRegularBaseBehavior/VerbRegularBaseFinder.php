<?php

namespace Skyeng\Dictionary\FindRegularBaseBehavior;

use Skyeng\Word;

class VerbRegularBaseFinder extends AbstractRegularBaseFinder {
  /**
   * @inheritdoc
   */
  public function getRegularBases(Word $word) {
    $bases = [];

    if($word->isEndsWithEs()) {
      $bases[] = $verbBase = substr($word->asString(), 0, -2);
      if(!isset($this->partOfSpeech->getWordsList()[$verbBase]) || $this->partOfSpeech->getWordsList()[$verbBase] !== $verbBase) {
        $bases[] = substr($word->asString(), 0, -1);
      }
    } elseif($word->isEndsWithVerbVowelYs()) {
      $bases[] = substr($word->asString(), 0, -1);
    } elseif($word->isEndsWith('ed') && !$word->isEndsWith('ied') && !$word->isEndsWith('cked')) {
      $bases[] = $pastBase = substr($word->asString(), 0, -1);
      if(!isset($this->partOfSpeech->getWordsList()[$pastBase]) || $this->partOfSpeech->getWordsList()[$pastBase] !== $pastBase) {
        $bases[] = substr($word->asString(), 0, -2);
      }
    } elseif($word->isEndsWith('ed') && $word->isDoubleConsonant('ed')) {
      $bases[] = substr($word->asString(), 0, -3);
      $bases[] = substr($word->asString(), 0, -2);
      $bases[] = substr($word->asString(), 0, -2) . 'e';
    } elseif($word->isEndsWith('ing') && $word->isDoubleConsonant('ing')) {
      $bases[] = substr($word->asString(), 0, -4);
      $bases[] = substr($word->asString(), 0, -3);
      $bases[] = substr($word->asString(), 0, -3) . 'e';
    } elseif($word->isEndsWith('ing') && !isset($this->partOfSpeech->getWordsExceptions()[$word->asString()])) {
      $bases[] = $ingBase = substr($word->asString(), 0, -3) . 'e';
      if(!isset($this->partOfSpeech->getWordsList()[$ingBase]) || $this->partOfSpeech->getWordsList()[$ingBase] !== $ingBase) {
        $bases[] = substr($word->asString(), 0, -3);
      }
    } elseif($word->isEndsWith('able') && $word->isEndsWith('able')) {
      $bases[] = substr($word->asString(), 0, -5);
    } elseif($word->isEndsWith('ability') && $word->isEndsWith('ability')) {
      $bases[] = substr($word->asString(), 0, -8);
    } elseif($word->isEndsWith('s')) {
      $bases[] = substr($word->asString(), 0, -1);
    }

    $bases = array_merge($bases, $this->getMorphologicalSubstitutionBases($word));
    $bases[] = $word->asString();

    return $this->filterValidBases($bases);
  }

  /**
   * @inheritdoc
   */
  protected function getMorphologicalSubstitutions() {
    return [
      ['ies', 'y'],
      ['ied', 'y'],
      ['cked', 'c'],
      ['cked', 'ck'],
      ['able', 'e'],
      ['able', ''],
      ['ability', 'e'],
      ['ability', ''],
    ];
  }
}
