<?php

namespace Skyeng;

class Word {
  /**
   * @var string
   */
  private $word;

  /**
   * @param string $word
   */
  public function __construct($word) {
    $this->word = $word;
  }

  /**
   * @return string
   */
  public function asString() {
    return $this->word;
  }

  /**
   * @return bool
   */
  public function isEndsWithEs() {
    $ends = ['ches', 'shes', 'oes', 'ses', 'xes', 'zes'];
    foreach($ends as $end) {
      if(substr($this->word, 0 - strlen($end)) == $end) {
        return true;
      }
    }

    return false;
  }

  /**
   * @return bool
   */
  public function isEndsWithVerbVowelYs() {
    $ends = ['ays', 'eys', 'iys', 'oys', 'uys'];
    foreach($ends as $end) {
      if(substr($this->word, 0 - strlen($end)) == $end) {
        return true;
      }
    }

    return false;
  }

  /**
   * @param string $end
   *
   * @return bool
   */
  public function isEndsWith($end) {
    return substr($this->word, -strlen($end)) === $end;
  }

  /**
   * @param string $suffix
   *
   * @return bool
   */
  public function isDoubleConsonant($suffix) {
    $length = strlen($this->word) - strlen($suffix);

    return $length > 2
      && Helper::isVowel($this->word[$length - 3])
      && !Helper::isVowel($this->word[$length - 2])
      && $this->word[$length - 2] === $this->word[$length - 1];
  }
}
