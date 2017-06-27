<?php

namespace Skyeng\Dictionary\FindIrregularBaseBehavior;

use Skyeng\Word;

class IrregularBaseFinder extends AbstractIrregularBaseFinder {
  /**
   * @inheritdoc
   */
  public function getIrregularBase(Word $word) {
    $wordString = $word->asString();
    $exceptions = $this->partOfSpeech->getExceptions();
    if(isset($exceptions[$wordString]) && $exceptions[$wordString] !== $wordString) {
      return $exceptions[$wordString];
    }

    return null;
  }
}
